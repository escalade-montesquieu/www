<?php

namespace App\Http\Livewire\Forum;

use App\Models\ForumMessage;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Messages extends Component
{
    public Collection $messages;

    public int $lastMessageId = 0;

    public int $messagesSliceLength = 20;

    public int $messagesToTake;

    public bool $isSeenPopupVisible = false;

    protected $listeners = [
        'messageSent' => 'onMessageSent',
        'forum.message.load-older' => 'loadOlderMessages'
    ];

    public function boot(): void
    {
        $this->messagesToTake = $this->messagesSliceLength;
    }

    public function onMessageSent(): void
    {
        $this->dispatchBrowserEvent('forum.message.sent');

        $this->render();
    }

    public function render()
    {
        $this->messages = ForumMessage::latest('created_at')
            ->take($this->messagesToTake)
            ->get()
            ->reverse();

        $this->updateUserLastMessageSeen();

        $this->dispatchEventIfMessageUpdated();

        return view('livewire.forum.messages');
    }

    public function updateUserLastMessageSeen(): void
    {
        if (!$this->messages->last()) {
            return;
        }

        auth()->user()->update([
            'forum_message_id' => $this->messages->last()->id
        ]);
    }

    public function dispatchEventIfMessageUpdated(): void
    {
        $newLastMessageId = $this->messages->last()?->id;

        if (!$newLastMessageId) {
            return;
        }

        if ($newLastMessageId !== $this->lastMessageId) {
            $this->dispatchBrowserEvent('forum.message.new');
        }

        $this->lastMessageId = $newLastMessageId;
    }

    public function loadOlderMessages(): void
    {
        $this->messagesToTake += $this->messagesSliceLength;

        $this->dispatchBrowserEvent('forum.message.older-loaded');
    }

    public function showSeenPopup(): void
    {
        $this->isSeenPopupVisible = true;
    }

    public function hideSeenPopup(): void
    {
        $this->isSeenPopupVisible = false;
    }
}
