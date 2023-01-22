<?php

namespace App\Console\Commands\Import;

use App\Enums\UserEmailPreference;
use App\Enums\UserRole;
use App\Models\Student;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportUsersFromCsv extends Command
{
    protected $signature = 'import:users';

    public function handle(): int
    {
        // Récupération du contenu du fichier CSV
        $csvFile = Storage::get('users.csv');

        // Conversion du contenu en tableau
        $csv = array_map('str_getcsv', explode("\n", $csvFile));

        $header = $csv[0];
        // Boucle sur chaque ligne du tableau (sauf la première qui contient les entêtes et la dernière qui est vide)
        for ($i = 1, $iMax = count($csv) - 1; $i < $iMax; $i++) {
            $data = array_combine($header, $csv[$i]);

            dump($data['name']);

            $email_preferences = [];
            if (str_contains($data['email_preferences'], 'e')) {
                $email_preferences[] = UserEmailPreference::EVENT_CREATION;
            }
            if (str_contains($data['email_preferences'], 'r')) {
                $email_preferences[] = UserEmailPreference::EVENT_REMINDER;
            }
            if (str_contains($data['email_preferences'], 'f')) {
                $email_preferences[] = UserEmailPreference::FORUM_MESSAGE_MENTION;
            }

            if ($data['img'] === '/assets/profiles/user.png') {
                $avatarUrl = NULL;
            } else {
                $avatarUrl = str_replace('/assets', '/storage', $data['img']);
            }


            if ($data['level'] !== "3") {
                $userData['student_id'] = Student::create([
                    'name' => $data['name']
                ])->id;
            }

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'email_preferences' => $email_preferences,
                'password' => $data['password'],
                'role' => match ($data['level']) {
                    "1" => UserRole::STUDENT,
                    "2" => UserRole::MODERATOR,
                    "3" => UserRole::ADMIN
                },
                'avatar_url' => $avatarUrl,
                'bio' => $data['bio'] === 'NULL' ? NULL : $data['bio'],
                'rent_shoes' => $data['shoes'] === "no-need" ? NULL : $data['shoes'],
                'rent_harness' => $data['harness']
            ]);
        }

        return Command::SUCCESS;
    }
}
