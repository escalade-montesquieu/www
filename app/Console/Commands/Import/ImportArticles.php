<?php

namespace App\Console\Commands\Import;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportArticles extends Command
{
    protected $signature = 'import:articles';

    public function handle(): int
    {
        $jsonFile = Storage::get('info.json');

        $json = json_decode($jsonFile, true, 512, JSON_THROW_ON_ERROR);

        $table = current(array_filter($json, static fn($row) => $row['type'] === 'table'));

        $rows = $table['data'];

        foreach ($rows as $row) {
            Article::create([
                'title' => $row['title'],
                'content' => $row['content'] === 'NULL' ? NULL : $row['content'],
                'display_homepage' => !$row['deleted_at']
            ]);
        }

        return Command::SUCCESS;
    }
}
