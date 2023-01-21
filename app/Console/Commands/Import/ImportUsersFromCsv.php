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

            $userData['name'] = $data['name'];

            $userData['email'] = $data['email'];

            $userData['email_preferences'] = [];
            if (str_contains($data['email_preferences'], 'e')) {
                $userData['email_preferences'][] = UserEmailPreference::EVENT_CREATION;
            }
            if (str_contains($data['email_preferences'], 'r')) {
                $userData['email_preferences'][] = UserEmailPreference::EVENT_REMINDER;
            }
            if (str_contains($data['email_preferences'], 'f')) {
                $userData['email_preferences'][] = UserEmailPreference::FORUM_MESSAGE_MENTION;
            }

            $userData['password'] = $data['password'];

            $userData['role'] = match ($data['level']) {
                "1" => UserRole::STUDENT,
                "2" => UserRole::MODERATOR,
                "3" => UserRole::ADMIN
            };

            if ($data['level'] !== "3") {
                $userData['student_id'] = Student::create([
                    'name' => $data['name']
                ])->id;
            }

            $userData['avatar_url'] = $data['img'];

            $userData['bio'] = $data['bio'];

            $userData['rent_shoes'] = $data['shoes'] === "no-need" ? NULL : $data['shoes'];

            $userData['rent_harness'] = $data['harness'];

            User::create($userData);
        }

        return Command::SUCCESS;
    }
}
