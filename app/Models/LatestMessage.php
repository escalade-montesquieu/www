<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LatestMessage extends Model
{
    public $timestamps = false;

    protected $table = 'latests_messages';

    protected $fillable = [
        'forum', 'id', 'created_at'
    ];
}
