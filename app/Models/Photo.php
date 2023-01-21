<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    public static string $STORAGE_FOLDER = 'photos';

    use HasFactory;

    protected $fillable = [
        'gallery',
        'title',
        'display_homepage',
        'src',
        'image_data'
    ];

    protected $attributes = [
        'display_homepage' => false,
    ];

    protected $casts = [
        'image_data' => 'array',
    ];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

    public function scopeOnHomepage($query)
    {
        return $query->where('display_homepage', true);
    }

    public function getAssetSrcAttribute(): string
    {
        return asset($this->publicSrc);
    }

    public function getPublicSrcAttribute(): string
    {
        return 'storage/' . self::$STORAGE_FOLDER . '/' . $this->src;
    }

    public function getStorageSrcAttribute(): string
    {
        return self::$STORAGE_FOLDER . '/' . $this->src;
    }
}
