<?php

namespace App\Http\Livewire\Forum;

use App\Models\ForumMessage;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Messages extends Component
{
    public Collection $messages;

    protected $listeners = ['messageSent' => 'render'];

    public function render()
    {
        $this->messages = ForumMessage::all();

        return view('livewire.forum.messages');
    }
}
