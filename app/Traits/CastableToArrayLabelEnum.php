<?php

namespace App\Traits;

trait CastableToArrayLabelEnum
{
    use CastableToValuesEnum;
    use CastableToLabelsEnum;

    public static function labelArray(): array
    {
        return array_combine(self::values(), self::labels());
    }
}
