<?php

namespace App\Console\Commands\Import;

use App\Models\EventCategory;
use Illuminate\Console\Command;

class ImportEventCategories extends ImportCommand
{
    protected $signature = 'import:event-categories';

    public function handle(): int
    {
        $rows = $this->loadJson('blog_list.json');

        foreach ($rows as $row) {

            dump($row['name']);

            EventCategory::create([
                'is_regular' => $row['is_regular'],
                'title' => $row['name'],
                'description' => $row['description']
            ]);
        }

        return Command::SUCCESS;
    }
}
