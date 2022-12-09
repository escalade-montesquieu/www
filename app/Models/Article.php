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
        'ressources_links',
        'display_homepage'
    ];

    protected $attributes = [
        'ressources_links' => '{}',
    ];

    protected $casts = [
        'ressources_links' => 'array',
    ];

    public function scopeOnHomepage($query)
    {
        return $query->where('display_homepage', true);
    }
}
