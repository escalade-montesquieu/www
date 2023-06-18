<?php

namespace App\Enums;

use App\Traits\CastableToArrayLabelEnum;

enum UserRole: string
{
    use CastableToArrayLabelEnum;

    case STUDENT = 'student';
    case MODERATOR = 'moderator';
    case ADMIN = 'admin';

    public function toLabel(): string
    {
        return match ($this) {
            self::STUDENT => 'Licencié',
            self::MODERATOR => 'Modérateur',
            self::ADMIN => 'Administrateur',
        };
    }

    public static function toArray(): array
    {
        $list = [];
        foreach (self::cases() as $case) {
            $list[$case->value] = $case->toLabel();
        }

        return $list;
    }
}
