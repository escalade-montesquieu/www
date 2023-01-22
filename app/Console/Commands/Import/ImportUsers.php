<?php

namespace App\Console\Commands\Import;

use App\Enums\UserEmailPreference;
use App\Enums\UserRole;
use App\Models\Student;
use App\Models\User;
use Illuminate\Console\Command;

class ImportUsers extends ImportCommand
{
    protected $signature = 'import:users';

    public function handle(): int
    {
        $rows = $this->loadJson('users.json');

        foreach ($rows as $row) {

            dump($row['name']);

            $email_preferences = [];
            if (str_contains($row['email_preferences'], 'e')) {
                $email_preferences[] = UserEmailPreference::EVENT_CREATION;
            }
            if (str_contains($row['email_preferences'], 'r')) {
                $email_preferences[] = UserEmailPreference::EVENT_REMINDER;
            }
            if (str_contains($row['email_preferences'], 'f')) {
                $email_preferences[] = UserEmailPreference::FORUM_MESSAGE_MENTION;
            }

            if ($row['img'] === '/assets/profiles/user.png') {
                $avatarUrl = NULL;
            } else {
                $avatarUrl = str_replace('/assets', '/storage', $row['img']);
            }

            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'email_preferences' => $email_preferences,
                'password' => $row['password'],
                'role' => match ($row['level']) {
                    "1" => UserRole::STUDENT,
                    "2" => UserRole::MODERATOR,
                    "3" => UserRole::ADMIN
                },
                'student_id' => $row['level'] === "3" ? NULL : Student::create([
                    'name' => $row['name']
                ])->id,
                'avatar_url' => $avatarUrl,
                'bio' => $row['bio'],
                'rent_shoes' => $row['shoes'] === "no-need" ? NULL : $row['shoes'],
                'rent_harness' => $row['harness']
            ]);
        }

        return Command::SUCCESS;
    }
}
