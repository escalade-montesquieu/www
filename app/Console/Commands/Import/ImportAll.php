<?php

namespace App\Console\Commands\Import;

use Illuminate\Console\Command;

class ImportAll extends ImportCommand
{
    protected $signature = 'import:all';

    public function handle(): int
    {
        \Artisan::call('import:users');
        \Artisan::call('import:articles');
        \Artisan::call('import:event-categories');
        \Artisan::call('import:events');
        \Artisan::call('import:galleries');
        \Artisan::call('import:photos');

        return Command::SUCCESS;
    }
}
