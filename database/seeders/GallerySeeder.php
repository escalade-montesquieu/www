<?php

namespace Database\Seeders;

use App\Models\Gallery;
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
            ->hasPhotos(10)
            ->create();

        foreach (Gallery::all() as $gallery) {
            $gallery->update([
                'photo_id' => $gallery->photos()->first()->id
            ]);
        }
    }
}
