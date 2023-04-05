<?php

namespace App\Console\Commands\Import;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

abstract class ImportCommand extends Command
{
    public function loadJson(string $file): array
    {
        $jsonFile = Storage::disk('local')->get($file);

        $json = json_decode($jsonFile, true, 512, JSON_THROW_ON_ERROR);

        $table = current(array_filter($json, static fn($row) => $row['type'] === 'table'));

        return $table['data'];
    }
}
