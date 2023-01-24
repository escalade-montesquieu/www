<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Repositories\EventRepository;
use Illuminate\Contracts\View\Factory;


class HomeController extends Controller
{
    public function show(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('home', [
            'photos' => Photo::onHomePage()->get(),
            'incomingEventDates' => EventRepository::incomingByDate()
        ]);
    }
}
