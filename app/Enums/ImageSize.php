<?php

namespace App\Enums;

use Nette\NotImplementedException;

enum ImageSize: string
{
    case UPLOADED = 'uploaded';
    case ORIGINAL = 'original';
    case LARGE = 'large';
    case SMALL = 'small';
    case TINY = 'tiny';

    public function getWidth(): int
    {
        return match ($this) {
            self::LARGE => 1000,
            self::SMALL => 400,
            self::TINY => 100,
            default => throw new NotImplementedException()
        };
    }
}
