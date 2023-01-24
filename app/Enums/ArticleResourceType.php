<?php

namespace App\Enums;

use App\Traits\CastableToArrayLabelEnum;

enum ArticleResourceType: string
{
    use CastableToArrayLabelEnum;

    case YOUTUBE_VIDEO = 'youtube-video';
    case INTERNAL_PHOTO = 'internal-photo';
    case EXTERNAL_PHOTO = 'external-photo';

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
            self::YOUTUBE_VIDEO => 'Vidéo youtube',
            self::INTERNAL_PHOTO => 'Photo interne',
            self::EXTERNAL_PHOTO => 'Photo externe',
        };
    }
}
