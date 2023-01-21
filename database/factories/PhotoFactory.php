<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
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

        $path = storage_path("app/public/photos");

        if (!File::isDirectory($path)) {
            File::makeDirectory($path);
        }

        $fakerFilePath = $faker->image(
            $path,
            800,
            600
        );


        return [
            'title' => fake()->sentence(),
            'display_homepage' => false,
            'src' => basename($fakerFilePath)
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
