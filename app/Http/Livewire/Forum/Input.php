<?php

namespace App\Http\Livewire\Forum;

use App\Mail\ForumMessageMentionMail;
use App\Models\ForumMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class Input extends Component
{
    public string $message = "";

    public bool $mentionAll = false;
    public array $usersToMention = [];

    public function render()
    {
        return view('livewire.forum.input');
    }

    public function sendMessage(): void
    {
        $this->message = htmlspecialchars($this->message);
        $this->message = $this->extractMentions($this->message);

        $forumMessage = ForumMessage::create([
            'user_id' => Auth::user()->id,
            'content' => $this->message,
        ]);

        $this->notifyMentionedUsers($forumMessage);

        $this->emit('messageSent');

        $this->reset();
    }

    public function extractMentions(string $message): string
    {
        return preg_replace_callback(
            REGEX_MENTIONS_IN_STRING,
            function ($matches): string {
                $mention = $matches[1];

                if ($mention === "tous") {
                    $this->mentionAll = true;
                    return $matches[0];
                }

                $userMentionedName = Str::toHumanUsername($mention);

                if (!$user = User::firstWhere('name', 'LIKE', $userMentionedName)) {
                    return $matches[0];
                }

                if (!$this->mentionAll) {
                    $this->usersToMention[] = $user;
                }

                return '@' . $user->id;
            },
            $message
        );
    }

    public function notifyMentionedUsers(ForumMessage $forumMessage): void
    {
        if ($this->mentionAll) {
            $this->usersToMention = User::all()->toArray();
        }

        if (count($this->usersToMention)) {
            Mail::bcc($this->usersToMention)->queue(new ForumMessageMentionMail($forumMessage));
        }
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
