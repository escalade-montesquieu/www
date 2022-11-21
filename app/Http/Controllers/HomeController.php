<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Photo;
use App\Repositories\EventRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function show(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('home', [
            'photos' => Photo::onHomePage()->get(),
            'articles' => Article::onHomePage()->get(),
            'incomingEventDates' => EventRepository::incomingByDate()
        ]);
    }
}
