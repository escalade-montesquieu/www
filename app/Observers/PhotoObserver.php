<?php

namespace App\Observers;

use App\Models\Photo;

class PhotoObserver
{
    public function saving(Photo $photo): void
    {
        Photo::withoutEvents(static function () use (&$photo) {
            $photo->image_data = getimagesize(storage_path('app/public/photos/' . $photo->src));

            $photo->saveQuietly();
        });
    }
}
