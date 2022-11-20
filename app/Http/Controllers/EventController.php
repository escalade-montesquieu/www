<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('events.index', [
            'events' => Event::all()
        ]);
    }
}
