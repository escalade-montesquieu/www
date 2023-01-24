<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'content',
        'resources',
    ];

    protected $attributes = [
        'resources' => '[]',
    ];

    protected $casts = [
        'resources' => 'array',
    ];

    public function getFirstResourceAttribute(): array|bool
    {
        return current($this->resources);
    }

    public function scopeThreeLatest($query)
    {
        return $query->latest()
            ->take(3);
    }
}
