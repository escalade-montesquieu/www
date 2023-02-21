<?php

namespace App\Http\Livewire\Forum;

use App\Models\ForumMessage;
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
        ForumMessage::create([
            'user_id' => Auth::user()->id,
            'content' => $this->message,
        ]);

        $this->emit('messageSent');

        $this->message = "";
    }
}
