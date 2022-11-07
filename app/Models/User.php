<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid', 'level', 'name', 'img', 'email', 'password', 'bio', 'max_voie', 'max_block', 'warn', 'updated_at', 'email_preferences'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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
        //     'title' => 'Message',
        //     'desc' => "Lorsqu'il y a des nouveaux messages sur le forum"
        // ]
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rollApiKey(){
        do{
            $this->api_token = Str::random(60);
        }while($this->where('api_token', $this->api_token)->exists());
        $this->save();
    }

    public function getEmailPrefsAttribute()
    {
        if($this->email_preferences == null) return [];
        $rules = array_keys($this->emailRules);
        $prefs = [];
        foreach ($rules as $rule) {
            if(str_contains($this->email_preferences, $rule)) {
                // array_push($prefs, $this->emailRules[$rule]);
                $prefs[$this->emailRules[$rule]['name']] = $this->emailRules[$rule]['desc'];
            }
        }
        return $prefs;
    }

    public function prefLetterFromName($prefname)
    {
        foreach ($this->emailRules as $letter => $rule) {
            if($rule['name'] == $prefname) {
                return $letter;
            }
        }
        return NULL;
    }

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
