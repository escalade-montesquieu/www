<?php

namespace App\Traits;

trait CastableToLabelsEnum
{
    public static function labels(): array
    {
        return array_map(static fn($e)=>$e->toLabel(), self::cases());
    }
}
