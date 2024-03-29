<?php

namespace App\Models;

use App\Traits\HasImage;
use App\Traits\HasImagePathAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;
    use HasImage;
    use HasImagePathAttributes;

    protected $fillable = [
        'gallery_id',
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

    public static function getImageColumn(): string
    {
        return 'src';
    }

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
        return 'storage/' . self::getStorageFolder() . '/' . $this->src;
    }

    public static function getStorageFolder(): string
    {
        return 'photos';
    }
}
