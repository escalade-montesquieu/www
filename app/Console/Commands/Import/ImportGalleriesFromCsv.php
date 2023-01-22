<?php

namespace App\Console\Commands\Import;

use App\Models\Gallery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportGalleriesFromCsv extends Command
{
    protected $signature = 'import:galleries';

    public function handle(): int
    {
        // Récupération du contenu du fichier CSV
        $csvFile = Storage::get('gallery.csv');

        // Conversion du contenu en tableau
        $csv = array_map('str_getcsv', explode("\n", $csvFile));

        $header = $csv[0];
        // Boucle sur chaque ligne du tableau (sauf la première qui contient les entêtes et la dernière qui est vide)
        for ($i = 1, $iMax = count($csv) - 1; $i < $iMax; $i++) {
            $data = array_combine($header, $csv[$i]);

            dump($data['name']);

            Gallery::create([
                'title' => $data['name'],
                'description' => $data['text'] === 'NULL' ? NULL : $data['text']
            ]);
        }

        return Command::SUCCESS;
    }
}
