<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use SoftDeletes, HasFactory;

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

    public function eventCategory(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }

    public function getIsUserParticipatingAttribute(): bool
    {
        if(!Auth::check()) {
            return false;
        }
        return $this->participants()->where('id', Auth::user()->id)->count();
    }

    public function getHarnessesNeededAttribute(): int
    {
        // todo
        return 0;
    }

    public function getShoesNeededAttribute(): int
    {
        // todo
        return 0;
    }

    public function scopeIncoming(Builder $query): Builder
    {
        return $query->where('datetime', '>', now())
            ->orderBy('datetime');
    }
}
