<?php

namespace App\Http\Controllers;

use App\Mail\EventCreationMail;
use App\Mail\EventReminderMail;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function eventCreated(Request $request, User $user = null)
    {
        return (new EventCreationMail(Event::first()))->render();
    }

    public function eventIncoming(Request $request, User $user = null)
    {
        return (new EventReminderMail(Event::first()))->render();
    }
}

