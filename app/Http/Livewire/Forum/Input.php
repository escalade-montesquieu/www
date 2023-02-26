<?php

namespace App\Http\Livewire\Forum;

use App\Enums\Regex;
use App\Models\ForumMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Input extends Component
{
    public string $message = "";

    public function render()
    {
        return view('livewire.forum.input');
    }

    public function sendMessage(): void
    {
        $this->message = $this->extractMentions($this->message);

        ForumMessage::create([
            'user_id' => Auth::user()->id,
            'content' => $this->message,
        ]);

        $this->emit('messageSent');

        $this->message = "";
    }

    public function extractMentions(string $message): string
    {
        return preg_replace_callback(
            REGEX_MENTIONS_IN_STRING,
            static function ($matches): string {
                $userMentionedName = str_replace('-', ' ', $matches[1]);

                if (!$user = User::firstWhere('name', 'LIKE', $userMentionedName)) {
                    return $matches[0];
                }

                return '@' . $user->id;
            },
            $message
        );
    }

    public function getUserMentionsSuggestionsProperty(): ?Collection
    {
        preg_match(
            REGEX_LAST_MENTION_IN_STRING,
            $this->message,
            $mentionMatches
        );

        if (!$mentionMatches) {
            return null;
        }

        $sluggedStartOfUsername = $mentionMatches[1];
        $normalStartOfUsername = Str::toHumanUsername($sluggedStartOfUsername);

        return User::where('name', 'LIKE', $normalStartOfUsername . '%')->get();
    }

    public function mentionUser(string $urlSluggedUsername): void
    {
        $this->message = preg_replace(
            REGEX_LAST_MENTION_IN_STRING,
            '@' . $urlSluggedUsername . ' ',
            $this->message
        );

        $this->dispatchBrowserEvent('forum.focus-input');
    }
}
