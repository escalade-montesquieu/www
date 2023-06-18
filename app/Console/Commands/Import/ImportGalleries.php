<?php

namespace App\Console\Commands\Import;

use App\Models\Gallery;
use Illuminate\Console\Command;

class ImportGalleries extends ImportCommand
{
    protected $signature = 'import:galleries';

    public function handle(): int
    {
        $rows = $this->loadJson('gallery.json');

        foreach ($rows as $row) {
            dump($row['name']);

            Gallery::create([
                'title' => $row['name'],
                'description' => $row['text']
            ]);
        }

        return Command::SUCCESS;
    }
}
