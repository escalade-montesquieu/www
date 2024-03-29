<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery::factory()
            ->count(3)
//            ->hasPhotos(10)
            ->create();

        return;
        foreach (Gallery::all() as $gallery) {
            $gallery->update([
                'photo_id' => $gallery->photos()->first()->id
            ]);

            Photo::factory()
                ->onHomepage()
                ->for($gallery)
                ->create();
        }
    }
}
