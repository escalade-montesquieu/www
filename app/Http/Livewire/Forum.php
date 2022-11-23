<?php

namespace App\Http\Livewire;

use App\Models\ForumMessage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Forum extends Component
{
    public Collection $messages;

    public string $writingMessage = "";

    public function render()
    {
        $this->messages = ForumMessage::all();

        return view('livewire.forum')
            ->layout('layouts.forum');
    }

    public function sendWritingMessage(): void
    {
        ForumMessage::create([
            'user_id' => Auth::user()->id,
            'content' => $this->writingMessage,
        ]);

        $this->writingMessage = "";
        $this->dispatchBrowserEvent('forum-message-sent');
    }
}
