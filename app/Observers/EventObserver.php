<?php

namespace App\Observers;

use App\Enums\UserEmailPreference;
use App\Mail\EventCreated;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EventObserver
{
    public function created(Event $event): void
    {
        $users = User::mailableFor(UserEmailPreference::EVENT_CREATION)
            ->get()
            ->toArray();

        Mail::bcc($users)->queue(new EventCreated($event));
    }

    public function updated(Event $event): void
    {
        //
    }

    public function deleted(Event $event): void
    {
        //
    }

    public function restored(Event $event): void
    {
        //
    }

    public function forceDeleted(Event $event): void
    {
        //
    }
}
