<?php

namespace App\Enums;

use App\Traits\CastableToArrayLabelEnum;

enum ArticleResourceType: string
{
    use CastableToArrayLabelEnum;

    case EXTERNAL_VIDEO = 'external-video';
    case INTERNAL_PHOTO = 'internal-photo';

    public static function toArray(): array
    {
        $list = [];
        foreach (self::cases() as $case) {
            $list[$case->value] = $case->toLabel();
        }

        return $list;
    }

    public function toLabel(): string
    {
        return match ($this) {
            self::EXTERNAL_VIDEO => 'Vidéo externe',
            self::INTERNAL_PHOTO => 'Photo',
        };
    }
}
