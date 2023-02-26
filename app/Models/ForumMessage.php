<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
        $replacement = "<a class='link' href='" . route('profile.show') . "/$1'>$0</a>";

        return preg_replace_callback(
            User::$MENTION_REGEX,
            static function ($matches): string {
                $userMentionedUUID = $matches[1];
                if (!$user = User::find($userMentionedUUID)) {
                    return "";
                }
                return "<a class='link' href='" . route('profile.show', $user) . "'>@" . $user->name . "</a>";
            },
            $this->content
        );
    }
}
