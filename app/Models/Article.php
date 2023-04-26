<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Article extends Model implements Sortable
{
    use SoftDeletes, HasFactory;
    use SortableTrait;

    public static int $countPinned = 3;

    protected $fillable = [
        'title',
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
