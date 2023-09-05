<?php

namespace App\Models;

use App\Enums\ArticleResourceType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Article extends Model implements Sortable
{
    use SoftDeletes, HasFactory;
    use SortableTrait;

    public static int $countPinned = 4;

    protected $fillable = [
        'title',
        'link',
        'content',
        'resources',
        'order_column',
    ];

    protected $attributes = [
        'resources' => '[]',
    ];

    protected $casts = [
        'resources' => 'array',
    ];

    protected static function booted(): void
    {
        static::created(static function (Article $article) {
            $article->moveToStart();
        });
    }

    public function getFirstResourceAttribute(): array|bool
    {
        return current($this->resources);
    }

    public function getFirstImageResourceAttribute(): ?array
    {
        return collect($this->resources)->whereIn('type', [ArticleResourceType::EXTERNAL_PHOTO->value, ArticleResourceType::INTERNAL_PHOTO])->first();
    }

    public function getFirstNotLinkResourceAttribute(): ?array
    {
        return collect($this->resources)->where('type', '!=', ArticleResourceType::LINK->value)->first();
    }

    public function getLinkResourcesAttribute(): Collection
    {
        return collect($this->resources)->where('type', ArticleResourceType::LINK->value);
    }

    public function getIsPinnedAttribute(): bool
    {
        return self::pinned()->pluck('id')->contains($this->id);
    }

    public function scopePinned(Builder $query): Builder
    {
        return $query->ordered()
            ->take(self::$countPinned);
    }
}
