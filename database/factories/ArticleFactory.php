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

            if ($resourceType === ArticleResourceType::YOUTUBE_VIDEO) {
                $resources[] = [
                    'type' => ArticleResourceType::YOUTUBE_VIDEO,
                    'title' => fake()->word(),
                    'url' => fake()->url(),
                ];
            } else {
                if($photo=Photo::inRandomOrder()->first()) {
                    $resources[] = [
                        'type' => ArticleResourceType::INTERNAL_PHOTO,
                        'title' => fake()->word(),
                        'photo_id' => $photo->id,
                    ];
                }
            }

        }

        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'resources' => $resources,
        ];
    }
}
