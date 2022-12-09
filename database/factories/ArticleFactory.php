<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $links = [];

        for ($i = 0; $i < fake()->numberBetween(0, 4); $i++) {
            $links[fake()->word()] = fake()->url();
        }

        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'ressources_links' => $links,
            'display_homepage' => false,
        ];
    }

    public function onHomepage(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'display_homepage' => true,
            ];
        });
    }
}
