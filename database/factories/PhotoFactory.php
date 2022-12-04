<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new FakerPicsumImagesProvider($faker));

        $fakerFileName = $faker->image(
            storage_path("app/public"),
            800,
            600
        );

        return [
            'display_homepage' => false,
            'src' => "storage/" . basename($fakerFileName)
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
