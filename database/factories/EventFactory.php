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
            'max_places' => fake()->numberBetween(0, 10)*10,
            'datetime' => fake()->date(),
            'location' => fake()->city(),
            'content' => fake()->paragraph()
        ];
    }
}
