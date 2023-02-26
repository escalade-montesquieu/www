<?php

namespace App\Http\Livewire\Forum;

use App\Enums\Regex;
use App\Models\ForumMessage;
use App\Models\User;
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
                $mention = $matches[1];

                if ($mention === "tous") {
                    return $matches[0];
                    // TODO : mention everyone
                }

                $userMentionedName = Str::toHumanUsername($mention);

                if (!$user = User::firstWhere('name', 'LIKE', $userMentionedName)) {
                    return $matches[0];
                }

                // TODO : if user mention user

                return '@' . $user->id;
            },
            $message
        );
    }

    public function getMentionSuggestionsProperty(): ?array
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
        $humanStartOfUsername = Str::toHumanUsername($sluggedStartOfUsername);

        $specialMatches = collect([
            [
                'id' => 'tous',
                'name' => 'Tous'
            ],
        ]);
        return [
            'users' => User::where('name', 'LIKE', $humanStartOfUsername . '%')->get(),
            'special' => $specialMatches->filter(static function ($item) use ($humanStartOfUsername) {
                return str_starts_with($item['name'], $humanStartOfUsername);
            })
        ];
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
