<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $timestamps = false;
    protected $table = 'subscriptions';

    protected $fillable = [
        'auth', 'endpoint', 'keys'
    ];
}
