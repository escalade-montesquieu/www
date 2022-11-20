<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EventCard extends Component
{
    public Event $event;

    public function render()
    {
        return view('livewire.event-card');
    }

    public function addParticipation(): void
    {
        if(!Auth::check()) {
            $this->redirect('login');
            return;
        }
        Auth::user()->events()->attach($this->event);
        $this->event->refresh();
    }

    public function removeParticipation(): void
    {
        if(!Auth::check()) {
            $this->redirect('login');
            return;
        }
        Auth::user()->events()->detach($this->event);
        $this->event->refresh();
    }
}
