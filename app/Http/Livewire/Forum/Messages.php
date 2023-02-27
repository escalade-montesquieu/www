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

        $this->dispatchEventIfMessageUpdated();

        return view('livewire.forum.messages');
    }

    public function dispatchEventIfMessageUpdated(): void
    {
        $newLastMessageId = $this->messages->last()->id;

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
}
