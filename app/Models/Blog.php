<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = false;
    protected $table = 'blog_list';

    protected $fillable = [
        'name', 'slug', 'description', 'is_regular'
    ];

}
