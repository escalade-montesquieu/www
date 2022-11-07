<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    protected $table = 'info';

    protected $fillable = [
        'title', 'content'
    ];
}
