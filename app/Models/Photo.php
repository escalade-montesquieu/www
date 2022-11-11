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
		'pinned_homepage',
		'src',
	];

    protected $attributes = [
        'pinned_homepage' => false,
    ];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

	public function scopePinnedHomepage($query) {
		return $query->where('pinned_homepage', 1);
	}
}
