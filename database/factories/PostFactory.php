<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserEventParticipartion>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'blog' => 'session-au-lycee',
            'title' => 'Session 12h-14h',
            'location' => 'Lycée Montesquieu',
            'content' => 'Lorem ipsum',
            'datetime' => '2020-10-10',
            'maxplaces' => fake()->numberBetween(-1, 50),
            'availables' => '{}',
            'unavailables' => '[]',
        ];
    }
}
