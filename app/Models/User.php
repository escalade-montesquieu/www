<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
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
        'email_preferences' => '',
        'max_voie' => 'Non renseignée',
        'max_bloc' => 'Non renseignée',
        'display_max' => true,
        'rent_harness' => false,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public $emailRules = [
        'e' => [
            'name' => 'event',
            'title' => 'Évènement',
            'desc' => "Lorsqu'un nouvel évènement est ajouté"
        ],
        'r' => [
            'name' => 'reminder',
            'title' => 'Rappel',
            'desc' => "Deux jours avant la date d'un évènement auquel je participe"
        ],
        // 'm' => [
        //     'name' => 'message',
        //     'title' => 'ForumMessage',
        //     'desc' => "Lorsqu'il y a des nouveaux messages sur le forum"
        // ]
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withTimestamps();
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
        return "https://ui-avatars.com/api/?name=$this->name&rounded=true";
    }

    public function canAccessFilament(): bool
    {
        return $this->role === UserRole::ADMIN->value;
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }


    // todo
    public function isMailableFor($prefname)
    {
        return str_contains($this->email_preferences, $prefname);

    }

    public function scopeMailableFor($query, $prefname)
    {
        $pref = $this->prefLetterFromName($prefname);
        return $query->where('email_preferences', 'LIKE', "%$pref%");
    }


}
