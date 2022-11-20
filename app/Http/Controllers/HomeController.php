<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Photo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function show(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('home', [
            'photos' => Photo::onHomePage()->get(),
            'articles' => Article::onHomePage()->get(),
            'incomingEvents' => Event::incoming()->take(4)->get()
        ]);
    }
}
