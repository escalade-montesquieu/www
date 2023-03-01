<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserEmailPreference;
use App\Enums\UserRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName, HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasUuids;

    protected $fillable = [
        'role',
        'password',
        'email',
        'email_preferences',

        'student_id',
        'name',
        'avatar_url',
        'bio',
        'max_voie',
        'max_block',
        'display_max',
        'rent_shoes',
        'rent_harness'
    ];

    protected $attributes = [
        'role' => UserRole::STUDENT,
        'email_preferences' => '{}',
        'max_voie' => 'Non renseignée',
        'max_bloc' => 'Non renseignée',
        'display_max' => true,
        'rent_harness' => false,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_preferences' => 'array',
        'email_verified_at' => 'datetime',
        'role' => UserRole::class,
    ];

    public static function getShoesSizesAvailable(): array
    {
        $opt = [];
        for ($i = 36; $i <= 50; $i++) {
            $opt[$i] = 'T' . $i;
        }

        return $opt;
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withTimestamps();
    }

    public function lastMessageSeen(): BelongsTo
    {
        return $this->belongsTo(ForumMessage::class, 'forum_message_id');
    }

    public function getClimbingStuffSentenceAttribute(): string
    {
        if (!$this->rent_harness && !$this->rent_shoes) {
            return "Vous n'empruntez aucun matériel";
        }

        if (!$this->rent_harness && $this->rent_shoes) {
            return "Vous avez votre baudrier, des chaussons taille $this->rent_shoes vous sont réservés";
        }

        if ($this->rent_harness && !$this->rent_shoes) {
            return "Vous avez vos chaussons, un baudrier vous est réservé";
        }

        return "Un baudrier et des chaussons taille $this->rent_shoes vous sont réservés";
    }

    public function getAvatarAttribute(): string
    {
        return $this->avatar_url ?? "https://ui-avatars.com/api/?name=$this->name&rounded=true";
    }

    public function getUsernameAttribute(): string
    {
        return $this->student->name ?? $this->name;
    }

    public function getSluggedUsernameAttribute(): string
    {
        return str_replace(' ', '-', strtolower($this->username));
    }

    public function canAccessFilament(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar;
    }

    public function isMailableFor(UserEmailPreference $mailable): bool
    {
        return in_array($mailable->value, $this->email_preferences, true);
    }

    public function scopeMailableFor(Builder $query, UserEmailPreference $mailable): Builder
    {
        return $query->where('email_preferences', 'like', '%' . $mailable->value . '%');
    }

    public function scopeRentShoes(Builder $query): Builder
    {
        return $query->whereNotNull('rent_shoes')->orderBy('rent_shoes');
    }

    public function scopeRentHarness(Builder $query): Builder
    {
        return $query->where('rent_harness', true);
    }
}
