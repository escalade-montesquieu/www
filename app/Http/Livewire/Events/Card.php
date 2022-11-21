<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Card extends Component
{
    public Event $event;

    public function render()
    {
        return view('livewire.events.card');
    }

    public function participationGate(): bool
    {
        if(!Auth::check()) {
            $this->redirect('login');
            return false;
        }

        if($this->event->isPast) {
            return false;
        }

        return true;
    }

    public function addParticipation(): void
    {
        if(!$this->participationGate()) {
            return;
        }

        Auth::user()->events()->attach($this->event);
        $this->event->refresh();
    }

    public function removeParticipation(): void
    {
        if(!$this->participationGate()) {
            return;
        }

        Auth::user()->events()->detach($this->event);
        $this->event->refresh();
    }
}
