<?php

namespace App\Http\Livewire\Forum;

use App\Models\ForumMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
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
        $this->extractMentions($this->message);

        ForumMessage::create([
            'user_id' => Auth::user()->id,
            'content' => $this->message,
        ]);

        $this->emit('messageSent');

        $this->message = "";
    }

    public function extractMentions(string $message): void
    {
        preg_match_all(User::$MENTION_REGEX, $message, $mentions);

//        dd($mentions);
    }

    public function getUserMentionsSuggestionsProperty(): ?Collection
    {
        preg_match('/@(\w*)$/', $this->message, $mention);

        if (!$mention) {
            return null;
        }

        $userNameMention = $mention[1];
        return User::where('name', 'LIKE', $userNameMention . '%')->get();
    }

    public function mentionUser(string $username): void
    {
        $this->message = preg_replace(
            '/@(\w*)$/',
            '@' . $username,
            $this->message
        );
    }
}
