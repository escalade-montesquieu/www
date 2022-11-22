<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Card extends Component
{
    public Event $event;

    public function render()
    {
        return view('livewire.events.card');
    }

    public function addParticipation(): void
    {
        if(!Auth::check()) {
            $this->redirect('login');
            return;
        }

        if(Gate::inspect('participate', $this->event)->denied()) {
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

        if(Gate::inspect('unparticipate', $this->event)->denied()) {
            return;
        }

        Auth::user()->events()->detach($this->event);
        $this->event->refresh();
    }
}
