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
        'display_homepage'
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

    public function scopeOnHomepage($query)
    {
        return $query->where('display_homepage', true);
    }
}
