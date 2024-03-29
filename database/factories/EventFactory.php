<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'max_places' => fake()->boolean() ? null : fake()->numberBetween(0, 10) * 10,
            'datetime' => fake()->boolean() ? null : fake()->dateTimeBetween('-1 year', '+2 year'),
            'location' => fake()->boolean() ? null : fake()->city(),
            'description' => fake()->paragraph()
        ];
    }

    public function incoming(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'datetime' => fake()->dateTimeBetween('+1 week', '+1 year'),
            ];
        });
    }

    public function past(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'datetime' => fake()->dateTimeBetween('-1 year', '-1 week'),
            ];
        });
    }
}
