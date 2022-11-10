<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use App\Models\UserEventParticipartion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index() {
        $blogs = EventCategory::all();
        $regulars = EventCategory::where('is_regular', 1)->get();
        $non_regulars = EventCategory::where('is_regular', 0)->get();

        return view('blog.index', compact('regulars', 'non_regulars'));
    }

    public function create() {
        return view('blog.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:blog_list,name',
            'slug' => 'required|string|max:255|unique:blog_list,slug',
            'is_regular' => 'required|boolean',
            'description' => 'nullable|string'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $blog = EventCategory::create([
            'name' => request('name'),
            'slug' => request('slug'),
            'is_regular' => request('is_regular'),
            'description' => request('description')
        ]);

        return redirect()->route('blogs')->with('status', 'success')->with('content', 'Blog créé');
    }


    public function show(Request $request, $blog_slug) {
        $blog = EventCategory::where('slug', $blog_slug)->firstOrFail();
        $posts = UserEventParticipartion::where('blog', $blog_slug)->orderBy('datetime', 'asc')->get();

        return view('blog.show', compact('blog', 'posts'));
    }

    public function edit($blog_slug) {
        $blog = EventCategory::where('slug', $blog_slug)->firstOrFail();

        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, $blog_slug) {
        $blog = EventCategory::where('slug', $blog_slug)->firstOrFail();


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:blog_list,name,'.$blog->id,
            'slug' => 'required|string|max:255|unique:blog_list,slug,'.$blog->id,
            'is_regular' => 'required|boolean',
            'description' => 'nullable|string'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }


        if($blog->slug !== request('slug')) {
            $blog->slug = request('slug');
            $posts = UserEventParticipartion::where('blog', $blog_slug)->update(['blog' => request('slug')]);
        }

        $blog->name = request('name');
        $blog->is_regular = request('is_regular');
        $blog->description = request('description');
        $blog->save();

        $posts = UserEventParticipartion::where('blog', request('slug'))->get();
        // return view('blog.show', compact('blog', 'posts'))->with('status', 'success')->with('content', 'Blog mis à jour');
        return redirect()->route('showBlog', $blog->slug)->with('status', 'success')->with('content', 'Blog mis à jour');
    }

    public function destroy($blog_slug) {
        $blog = EventCategory::where('slug', $blog_slug)->firstOrFail();

        $blog->delete();
        return redirect()->route('blogs');
    }
}
