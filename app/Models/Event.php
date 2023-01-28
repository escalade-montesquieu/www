<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'datetime',
        'location',
        'description',
        'max_places',
        'event_category_id',
    ];

    protected $attributes = [
        'max_places' => -1,
    ];

    protected $casts = [
        'datetime' => 'date'
    ];

    public function eventCategory(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function getIsUserParticipatingAttribute(): bool
    {
        if (!Auth::check()) {
            return false;
        }
        return $this->participants()->where('id', Auth::user()->id)->count();
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }

    public function getIsPastAttribute(): bool
    {
        return $this->datetime->isPast();
    }

    public function getHarnessesNeededAttribute(): int
    {
        return $this->participants()->rentHarness()->count();
    }

    public function getShoesNeededAttribute(): int
    {
        return $this->participants()->rentShoes()->count();
    }

    public function getLocationMapsLinkAttribute(): string
    {
        return "https://www.google.fr/maps/search/$this->location+france";
    }

    public function getIframeMapsLinkAttribute(): string
    {
        return "https://www.google.com/maps/embed/v1/place?q=$this->location+france&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8";
    }

    public function scopeIncoming(Builder $query): Builder
    {
        return $query->where('datetime', '>', now())
            ->orderBy('datetime');
    }

    public function scopeSoon(Builder $query): Builder
    {
        return $query->whereDate('datetime', now()->addDays(3))
            ->orderBy('datetime');
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where('datetime', '<', now())
            ->orderBy('datetime');
    }
}
