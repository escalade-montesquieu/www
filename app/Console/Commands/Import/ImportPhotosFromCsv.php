<?php

namespace App\Console\Commands\Import;

use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportPhotosFromCsv extends Command
{
    protected $signature = 'import:photos';

    public function handle(): int
    {
        // Récupération du contenu du fichier CSV
        $csvFile = Storage::get('photos.csv');

        // Conversion du contenu en tableau
        $csv = array_map('str_getcsv', explode("\n", $csvFile));

        $header = $csv[0];
        // Boucle sur chaque ligne du tableau (sauf la première qui contient les entêtes et la dernière qui est vide)
        for ($i = 1, $iMax = count($csv) - 1; $i < $iMax; $i++) {
            $data = array_combine($header, $csv[$i]);

            dump($data['id']);

            $srcWithoutVersion = explode('?', $data['src'])[0];
            $fileBasename = File::basename($srcWithoutVersion);

            Photo::create([
                'gallery_id' => Gallery::where('title', $data['gallery_name'])
                    ->firstOrCreate([
                        'title' => $data['gallery_name']
                    ])
                    ->id,
                'title' => $data['name'] === 'NULL' ? NULL : $data['name'],
                'display_homepage' => $data['exposed'],
                'src' => $fileBasename
            ]);
        }

        return Command::SUCCESS;
    }
}
