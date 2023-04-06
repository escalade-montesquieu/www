<?php

namespace App\Traits;

use App\Enums\ImageSize;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait HasImage
{
    public function optimize(ImageSize $imageSize): static
    {
        if (!$this->getImageBasename()) {
            return $this;
        }

        $uploadedImage = Storage::get($this->getImagePathFromUpload());

        $optimizedImage = Image::make($uploadedImage)
            ->resize($imageSize->getWidth(), null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode($this->getImageExtension());
        $optimizedPath = $this->getImagePathForSize($imageSize);

        Storage::disk('public')->put(
            $optimizedPath,
            $optimizedImage
        );

        return $this;
    }

    public function getImageBasename(): ?string
    {
        $column = self::getImageColumn();
        return $this->{$column};
    }

    public function getImagePathFromUpload(): ?string
    {
        $folder = self::getStorageFolder();
        $file = $this->getImageBasename();

        return "$folder/$file";
    }

    public function getImageExtension(): string
    {
        return pathinfo($this->getImageBasename(), PATHINFO_EXTENSION);
    }

    public function getImagePathForSize(ImageSize $size): ?string
    {
        if (!$this->getImageBasename()) {
            return null;
        }

        $filename = pathinfo($this->getImageBasename(), PATHINFO_FILENAME);
        $folder = self::getStorageFolder();
        $extension = $this->getImageExtension();

        return "$folder/$filename/$size->value.$extension";
    }

    abstract public static function getImageColumn(): string;

    abstract public static function getStorageFolder(): string;
}
