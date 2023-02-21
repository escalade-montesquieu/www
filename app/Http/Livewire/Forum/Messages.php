<?php

namespace App\Http\Livewire\Forum;

use App\Models\ForumMessage;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Messages extends Component
{
    public Collection $messages;

    public int $messagesCount = 0;

    protected $listeners = ['messageSent' => 'onMessageSent'];

    public function onMessageSent()
    {
        $this->dispatchBrowserEvent('forum.message.sent');

        $this->render();
    }

    public function render()
    {
        $this->messages = ForumMessage::all();

        $this->dispatchEventIfMessageUpdated();

        return view('livewire.forum.messages');
    }

    public function dispatchEventIfMessageUpdated(): void
    {
        $newMessagesCount = $this->messages->count();

        if ($newMessagesCount !== $this->messagesCount) {
            $this->dispatchBrowserEvent('forum.message.new');
        }

        $this->messagesCount = $newMessagesCount;
    }
}
