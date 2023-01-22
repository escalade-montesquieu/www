<?php

namespace App\Console\Commands\Import;

use App\Models\EventCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportEventCategoriesFromCsv extends Command
{
    protected $signature = 'import:event-categories';

    public function handle(): int
    {
        // Récupération du contenu du fichier CSV
        $csvFile = Storage::get('blog_list.csv');

        // Conversion du contenu en tableau
        $csv = array_map('str_getcsv', explode("\n", $csvFile));

        $header = $csv[0];
        // Boucle sur chaque ligne du tableau (sauf la première qui contient les entêtes et la dernière qui est vide)
        for ($i = 1, $iMax = count($csv) - 1; $i < $iMax; $i++) {
            $data = array_combine($header, $csv[$i]);

            dump($data['name']);

            EventCategory::create([
                'is_regular' => $data['is_regular'],
                'title' => $data['name'],
                'description' => $data['description'] === 'NULL' ? NULL : $data['description']
            ]);
        }

        return Command::SUCCESS;
    }
}
