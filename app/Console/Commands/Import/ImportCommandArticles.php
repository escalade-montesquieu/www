<?php

namespace App\Console\Commands\Import;

use App\Models\Article;
use Illuminate\Console\Command;

class ImportCommandArticles extends ImportCommand
{
    protected $signature = 'import:articles';

    public function handle(): int
    {
        $rows = $this->loadJson('info.json');

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
