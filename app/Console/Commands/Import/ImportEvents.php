<?php

namespace App\Console\Commands\Import;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Console\Command;

class ImportEvents extends ImportCommand
{
    protected $signature = 'import:events';

    public function handle(): int
    {
        $rows = $this->loadJson('blog_posts.json');

        foreach ($rows as $row) {
            dump($row['id']);

            Event::make([
                'event_category_id' => EventCategory::firstWhere('slug', $row['blog'])->id,
                'title' => $row['title'],
                'max_places' => $row['maxplaces'] === "-1" ? NULL : $row['maxplaces'],
                'datetime' => $row['datetime'],
                'location' => $row['location'],
                'description' => $row['content']
            ])
                ->saveQuietly();

        }

        return Command::SUCCESS;
    }
}
