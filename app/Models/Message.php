<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;

    protected $table = 'forum_messages';

    protected $fillable = [
        'forum', 'author', 'author_uuid', 'content'
    ];
}
