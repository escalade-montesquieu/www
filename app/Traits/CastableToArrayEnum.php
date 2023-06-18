<?php

namespace App\Traits;

trait CastableToArrayEnum
{
    use CastableToValuesEnum;
    use CastableToNamesEnum;

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }
}
