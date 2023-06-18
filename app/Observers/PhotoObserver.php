<?php

namespace App\Observers;

use App\Enums\ImageSize;
use App\Models\Photo;

class PhotoObserver
{
    public function saving(Photo $photo): void
    {
        Photo::withoutEvents(static function () use (&$photo) {
            $originalPath = storage_path('app/public/photos/' . $photo->src);

            $photo->image_data = getimagesize($originalPath);

            $photo->optimize(ImageSize::LARGE);
            $photo->optimize(ImageSize::SMALL);
            $photo->optimize(ImageSize::TINY);

            $photo->saveQuietly();
        });
    }
}
