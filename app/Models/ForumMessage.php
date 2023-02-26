<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ForumMessage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'content'
    ];

    public function getIsSentBySelfAttribute(): bool
    {
        return Auth::user()->id === $this->user->id;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getHtmlWithMentionsAttribute(): string
    {
        $htmlWithUserMentions = preg_replace_callback(
            REGEX_MENTION_UUID_FORMAT,
            static function ($matches): string {
                $userMentionedUUID = $matches[1];

                if (!$user = User::find($userMentionedUUID)) {
                    return "";
                }

                $sluggedUsernameMention = '@' . Str::toSluggedUsername($user->username);

                return "<a class='link' href='" . route('profile.show', $user) . "'>" . $sluggedUsernameMention . "</a>";
            },
            $this->content
        );

        $htmlWithSpecialMentions = preg_replace(
            REGEX_MENTION_SPECIAL,
            "<span class='link'>$0</span>",
            $htmlWithUserMentions
        );
        
        return $htmlWithSpecialMentions;
    }
}
