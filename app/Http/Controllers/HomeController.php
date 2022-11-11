<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Article;
use App\Models\Photo;
use App\Models\UserEventParticipartion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index() {



        $current_datetime = strtotime(Carbon::now()->toDateString());

        $infos = Article::all();
        // $comingPosts = Post::orderBy('datetime')->get()->filter(function ($post) use ($current_datetime) {
        //     $diff = (strtotime(explode(" ", $post->datetime)[0])-$current_datetime)/172800; // 2semaines
        //     return (0 <= $diff);
        // })->values()->take(5);

        $comingPosts = UserEventParticipartion::orderBy('datetime')->get()->filter(function ($post) use ($current_datetime) {
            $diff = (strtotime(explode(" ", $post->datetime)[0])-$current_datetime); // évènement pas encore passé
            return (0 <= $diff);
        })->values()->take(5);

        $forums = Forum::all();
        $exposedPhotos = Photo::exposed()->get();

        // return response()->json([$comingPosts]);
        return view('home', compact('infos','comingPosts', 'forums', 'exposedPhotos'));
    }
}
