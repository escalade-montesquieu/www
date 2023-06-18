<?php

namespace Database\Factories;

use App\Enums\UserEmailPreference;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $emailPreferences = UserEmailPreference::values();
        $nEmailPreferences = fake()->numberBetween(0, count($emailPreferences));
        
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'bio' => fake()->text(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'email_preferences' => fake()->randomElements($emailPreferences, $nEmailPreferences)
        ];
    }


    public function moderator(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => UserRole::MODERATOR,
            ];
        });
    }

    public function admin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => UserRole::ADMIN,
            ];
        });
    }
}
