<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;

	protected $fillable = [
		'gallery',
		'display_homepage',
		'src',
	];

    protected $attributes = [
        'display_homepage' => false,
    ];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

	public function scopeOnHomepage($query) {
		return $query->where('display_homepage', true);
	}
}
