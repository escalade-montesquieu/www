<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function participate(User $user, Event $event): bool
    {
        return !$event->isPast;
    }

    public function unparticipate(User $user, Event $event): bool
    {
        return !$event->isPast;
    }
}
