<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use App\Models\UserEventParticipartion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use App\Notifications\EventNotification;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Http;
// use App\Mail\EventNotification;
use App\Jehona\EventJehona;

// use Illuminate\Support\Facades\Mail;
// use App\Mail\EventNotification;
// use App\Jobs\EventEmailJob;

class PostController extends Controller
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'blog' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            $blog = '';
        }

        $blogs = EventCategory::all();
        $blog_slug = request('blog');
        return view('post.create', compact('blogs', 'blog_slug'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'blog' => 'required|string|max:255',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'location' => 'nullable|string|max:255',
            'maxplaces' => 'nullable|numeric',
            'content' => 'nullable|string'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $post = UserEventParticipartion::create([
            'title' => request('title'),
            'blog' => request('blog'),
            'datetime' => request('datetime'),
            'location' => request('location'),
            'maxplaces' => request('maxplaces'),
            'content' => request('content'),
            'availables' => '{}',
            'unavailables' => '[]',
        ]);




        // notify
        // $emailJob = (new EventEmailJob($post, [
        //     'bccEmails'=> $toNotify->pluck('email'),
        //     'bccNames' => $toNotify->pluck('name')
        // ]))->delay(now());

        // $emailJob = (new EventEmailJob($post, [
        //     'bccEmails'=> $toNotify->pluck('email'),
        //     'bccNames' => $toNotify->pluck('name')
        // ]))->delay(now());

        // dispatch($emailJob);
        // // next is handle by worker


        $eventJehona = new EventJehona($post);

        $eventJehona->dispatch();

        // now we can return the route
        return redirect()->route('showBlog', request('blog'))->with('status', 'success')->with('content', 'Post créé');
    }

    public function show($post_id) {
        if(! $post = UserEventParticipartion::where('id', $post_id)->first()) {
            return abort('404');
        }

        return response()->json($post);
    }

    public function edit($post_id) {
        if(! $post = UserEventParticipartion::where('id', $post_id)->first()) {
            return redirect('404');
        }
        $blogs = EventCategory::all();
        return view('post.edit', compact('post', 'blogs'));
    }

    public function update(Request $request, $post_id) {
        if(! $post = UserEventParticipartion::where('id', $post_id)->first()) {
            return redirect('404');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'blog' => 'required|string|max:255',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'location' => 'nullable|string|max:255',
            'maxplaces' => 'nullable|numeric',
            'content' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $post->title = request('title');
        $post->blog = request('blog');
        $post->datetime = request('datetime');
        $post->location = request('location');
        $post->maxplaces = request('maxplaces');
        $post->content = request('content');
        $post->save();

        return redirect()->route('showBlog', request('blog'))->with('status', 'success')->with('content', 'Post mis à jour');
    }

    public function available(Request $request, $post_id) {
        if(! $post = UserEventParticipartion::where('id', $post_id)->first()) {
            return response()->json('Not found', 404);
        }

        // décodage des listes json
        $availables = json_decode($post->availables, true);
        if(count($availables) >= $post->maxplaces && $post->maxplaces !== -1) {

            return response()->json(["error"=>"Hé ho, toutes les places sont prises!", "code"=>"full"], 400);
        }

        $unavailables = json_decode($post->unavailables, false);

        // mise à jour ou définition de l'utilisateur dans la liste "disponible"
        $availables[Auth::user()->name] = [Auth::user()->harness, Auth::user()->shoes];

        // retrait de l'utilisateur de la liste "indisponible"
        foreach (array_keys($unavailables, Auth::user()->name) as $key) {
            unset($unavailables[$key]);
        }

        // encodage des listes json
        $post->availables = json_encode($availables);
        $post->unavailables = json_encode(array_values($unavailables));

        $post->save();
        return response()->json($post);
    }

    public function unavailable(Request $request, $post_id) {
        if(! $post = UserEventParticipartion::where('id', $post_id)->first()) {
            return response()->json('Not found', 404);
        }

        // décodage des listes json
        $availables = json_decode($post->availables, true);
        $unavailables = json_decode($post->unavailables, false);

        // retrait de l'utilisateur dans la liste "disponible"
        unset($availables[Auth::user()->name]);

        // ajout de l'utilisateur de la liste "indisponible"
        if(!in_array(Auth::user()->name, $unavailables, true)) {
            $unavailables[] = Auth::user()->name;
        }

        // encodage des listes json
        $post->availables = json_encode($availables);
        $post->unavailables = json_encode(array_values($unavailables));

        $post->save();

        return response()->json($post);
    }

    public function destroy($post_id) {
        if(! $post = UserEventParticipartion::where('id', $post_id)->first()) {
            return response()->json('Not found', 404);
        }
        $blog = $post->blog;
        $post->delete();

        return redirect()->route('showBlog', $blog)->with('status', 'success')->with('content', 'Post supprimé');
    }
}
