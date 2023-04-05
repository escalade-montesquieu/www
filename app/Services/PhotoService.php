<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PhotoService
{
    private static string $folder = 'clothing/';
    private static string $extension = 'jpg';

    private \Intervention\Image\Image $image;
    private string $toFilename;

    public function __construct($image)
    {
        $this->image = Image::make($image);
        $this->toFilename = Str::uuid();
    }

    public static function optimize($image): static
    {
        $optimizedImage = Image::make($image)
            ->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode(self::$extension);

        return (new self($optimizedImage))->store();
    }

    public function store(): static
    {
        Storage::disk('public')->put(
            self::getPathFromFilename($this->toFilename),
            $this->image
        );

        return $this;
    }

    public static function getPathFromFilename(string $filename): string
    {
        return self::$folder . $filename . '.' . self::$extension;
    }

    public function getImage(): \Intervention\Image\Image
    {
        return $this->image;
    }

    public function getPath(): string
    {
        return self::getPathFromFilename($this->toFilename);
    }

    public function getFilename(): string
    {
        return $this->toFilename;
    }

    public function getFilenameWithExtension(): string
    {
        return $this->toFilename . '.' . self::$extension;
    }
}
