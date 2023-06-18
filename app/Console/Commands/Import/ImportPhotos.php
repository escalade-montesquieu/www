<?php

namespace App\Console\Commands\Import;

use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportPhotos extends ImportCommand
{
    protected $signature = 'import:photos';

    public function handle(): int
    {
        $rows = $this->loadJson('photos.json');

        foreach ($rows as $row) {

            dump($row['id']);

            $srcWithoutVersion = explode('?', $row['src'])[0];
            $fileBasename = File::basename($srcWithoutVersion);

            Photo::create([
                'gallery_id' => Gallery::where('title', $row['gallery_name'])
                    ->firstOrCreate([
                        'title' => $row['gallery_name']
                    ])
                    ->id,
                'title' => $row['name'],
                'display_homepage' => $row['exposed'],
                'src' => $fileBasename
            ]);
        }

        foreach (Gallery::all() as $gallery) {
            $photos = $gallery->photos;

            if ($photos->isEmpty()) {
                continue;
            }

            if ($photo = $gallery->photos->random()) {
                $gallery->update([
                    'photo_id' => $photo->id
                ]);
            }
        }

        return Command::SUCCESS;
    }
}
