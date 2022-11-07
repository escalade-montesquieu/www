<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $timestamps = false;
    protected $table = 'routes';

    protected $fillable = [
        'type',
        'diff',
        'color',
        'sectors'
    ];


    protected $casts = [
        'sectors' => 'array'
    ];
}
