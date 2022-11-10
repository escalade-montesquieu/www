<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Event extends Model
{
    protected $fillable = [
        'title',
        'datetime',
        'location',
        'content',
        'max_places',
    ];

    protected $attributes = [
        'max_places' => -1,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('participate')
            ->withTimestamps();
    }

    public function participants(): BelongsToMany
    {
        return $this->users()->wherePivot('participate', 1);
    }

    public function unavailables(): BelongsToMany
    {
        return $this->users()->wherePivot('participate', 0);
    }

    public function getHarnessesNeededAttributes(): int
    {
        // todo
        return 0;
    }

    public function getShoesNeededAttribute(): int
    {
        // todo
        return 0;
    }
}
