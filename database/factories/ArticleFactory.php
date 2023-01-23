<?php

namespace Database\Factories;

use App\Enums\ArticleResourceType;
use App\Models\Photo;
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
        $resources = [];

        for ($i = 0; $i < fake()->numberBetween(0, 4); $i++) {
            $resourceType = fake()->randomElement(ArticleResourceType::toArray());

            if ($resourceType === ArticleResourceType::EXTERNAL_VIDEO) {
                $resources[] = [
                    'type' => ArticleResourceType::EXTERNAL_VIDEO,
                    'title' => fake()->word(),
                    'url' => fake()->url(),
                ];
            } else {
                $resources[] = [
                    'type' => ArticleResourceType::INTERNAL_PHOTO,
                    'title' => fake()->word(),
                    'photo_id' => Photo::inRandomOrder()->first()->id,
                ];
            }

        }

        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'resources' => $resources,
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
