<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    public $timestamps = false;
    protected $table = 'forum_list';

    protected $fillable = [
        'name', 'slug', 'description'
    ];
}
