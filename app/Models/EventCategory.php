<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventCategory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_regular'
    ];

    public function events(): HasMany
    {
        return $this->hasMany(UserEventParticipartion::class);
    }
}
