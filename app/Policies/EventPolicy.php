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
        if ($event->is_past) {
            return false;
        }

        if ($event->is_full) {
            return false;
        }

        if ($event->isParticipating($user)) {
            return false;
        }

        return true;
    }

    public function unparticipate(User $user, Event $event): bool
    {
        if ($event->is_past) {
            return false;
        }

        if (!$event->isParticipating($user)) {
            return false;
        }

        return true;
    }
}
