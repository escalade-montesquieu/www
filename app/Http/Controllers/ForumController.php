<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function index() {
        $forums = Forum::all();
        return view('forum.index', compact('forums'));
    }

    public function create() {
        return view('forum.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:forum_list,name',
            'slug' => 'required|string|max:255|unique:forum_list,slug',
            'description' => 'nullable|string'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $forum = Forum::create([
            'name' => request('name'),
            'slug' => request('slug'),
            'description' => request('description')
        ]);

        return redirect()->route('showForum', request('slug'))->with('status', 'success')->with('content', 'Forum créé');
    }


    public function show(Request $request, $forum_slug) {
        $forum = Forum::where('slug', $forum_slug)->firstOrFail();
        $messages = Message::where('forum', $forum_slug)->take(20)->orderBy('id', 'desc')->get();
        return view('forum.show', compact('forum', 'messages'));
    }

    public function edit($forum_slug) {
        $forum = Forum::where('slug', $forum_slug)->firstOrFail();

        return view('forum.edit', compact('forum'));
    }

    public function update(Request $request, $forum_slug) {
        $forum = Forum::where('slug', $forum_slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:forum_list,name,'.$forum->id,
            'slug' => 'required|string|max:255|unique:forum_list,slug,'.$forum->id,
            'description' => 'nullable|string'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }


        if($forum->slug !== request('slug')) {
            $forum->slug = request('slug');
            Message::where('forum', $forum_slug)->update(['forum' => request('slug')]);
        }

        $forum->name = request('name');
        $forum->description = request('description');
        $forum->save();

        return redirect()->route('showForum', ['forum'=>request('slug')]);
    }

    public function destroy($forum_slug) {
        if(! $forum = forum::where('slug', $forum_slug)->first()) {
            return redirect('/forum');
        }

        $forum->delete();
        return redirect('/forum');
    }
}
