<?php

namespace App\Traits;

use App\Enums\ImageSize;

trait HasImagePathAttributes
{
    use HasImage;

    public function getOriginalImageAttribute(): ?string
    {
        return $this->getImagePathFromUpload();
    }

    public function getLargeImageAttribute(): ?string
    {
        return $this->getImagePathForSize(ImageSize::LARGE);
    }

    public function getSmallImageAttribute(): ?string
    {
        return $this->getImagePathForSize(ImageSize::SMALL);
    }

    public function getTinyImageAttribute(): ?string
    {
        return $this->getImagePathForSize(ImageSize::TINY);
    }
}
