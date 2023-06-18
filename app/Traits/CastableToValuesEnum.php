<?php

namespace App\Traits;

trait CastableToValuesEnum
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
