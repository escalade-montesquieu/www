<?php

namespace App\Http\Controllers;

use App\Mail\EventCreated;
use App\Mail\EventIncoming;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function eventCreated(Request $request, User $user = null)
    {
        return (new EventCreated(Event::first()))->render();
    }

    public function eventIncoming(Request $request, User $user = null)
    {
        return (new EventIncoming(Event::first()))->render();
    }
}

