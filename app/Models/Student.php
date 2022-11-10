<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id',
        'name',
        'get_degree_at_year',
        'role'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
