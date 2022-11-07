<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $table = 'blog_posts';

    protected $fillable = [
        'title', 'blog', 'datetime', 'location', 'content', 'availables', 'unavailables', 'maxplaces', 'harness_need', 'shoes_need'
    ];
}
