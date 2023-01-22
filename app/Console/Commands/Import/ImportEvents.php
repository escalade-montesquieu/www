<?php

namespace App\Console\Commands\Import;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportEventsFromCsv extends Command
{
    protected $signature = 'import:events';

    public function handle(): int
    {
        // Récupération du contenu du fichier CSV
        $csvFile = Storage::get('blog_posts.csv');

        // Conversion du contenu en tableau
        $csv = array_map('str_getcsv', explode("\n", $csvFile));

        $header = $csv[0];
        // Boucle sur chaque ligne du tableau (sauf la première qui contient les entêtes et la dernière qui est vide)
        for ($i = 1, $iMax = count($csv) - 1; $i < $iMax; $i++) {
            $data = array_combine($header, $csv[$i]);

            dump($data['id']);

            Event::make([
                'event_category_id' => EventCategory::firstWhere('slug', $data['blog'])->id,
                'title' => $data['title'],
                'max_places' => $data['maxplaces'] === "-1" ? NULL : $data['maxplaces'],
                'datetime' => $data['datetime'] === 'NULL' ? NULL : $data['datetime'],
                'location' => $data['location'] === 'NULL' ? NULL : $data['location'],
                'description' => $data['content'] === 'NULL' ? NULL : $data['content']
            ])
                ->saveQuietly();

        }

        return Command::SUCCESS;
    }
}
