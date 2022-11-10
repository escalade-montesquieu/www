<?php

namespace App\Traits;

trait CastableToNamesEnum
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }
}
