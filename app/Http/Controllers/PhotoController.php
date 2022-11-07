<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class PhotoController extends Controller
{
    public function index(Request $request) {
        $photos = photo::all()->reverse();
        return response()->json(compact('photos'), 200);
    }





    public function show($photo_slug) {

        if (! $photo = photo::where('slug', $photo_slug)->first())
        {
            abort(404, 'photo');
        }

        return view('photos.photo.show', compact('photo'));
    }




    public function create(Request $request) {
        $galleries = gallery::select('name', 'slug')->get();
        return view('photos.photo.create', compact('galleries', 'request'));
    }




    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'img' => 'required|image|mimes:jpeg,jpg',
            'slug' => 'nullable|unique:photos|string|max:255',
            'gallery' => 'required|string|max:255',
            'background' => 'required|string|max:255',
            'name' => 'nullable|unique:photos|string|max:255',
            'date' => 'nullable|max:255'
        ]);
        // return redirect('/')->with('status', 'danger')->with('content', 'Gallerie introuvable (lien invalide)');

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        if (! $gallery = gallery::where('slug', $request->gallery)->first() )
        {
            abort(404, 'gallery');
        }

        // $time = time();
        // $imageName = $time.'.'.request()->img->getClientOriginalExtension();
        // request()->img->move(public_path('img'), $imageName);
        $photo = photo::create([
            'slug'  => $request->get('slug')===''?time():$request->get('slug'),
            'gallery' => $request->get('gallery'),
            'gallery_name' => $gallery->name,
            'background' => $request->get('background'),
            // 'src' => '/img/'.$imageName,
            'src' => 'temp',
            'name' => $request->get('name'),
            'date' => $request->get('date'),
            'text' => $request->get('text'),
            'exposed' => $request->has('exposed')
        ]);
        $photo->saveOptimizedImage(request()->img);
        $photo->save();
        return redirect()->route('showGallery', $request->get('gallery'))->with('status', 'success')->with('content', 'Photo ajoutée');
    }



    public function edit($slug) {

        if (! $photo = photo::where('slug', $slug)->first())
        {
            abort(404, 'photo');
        }
        return view('photos.photo.edit', compact('photo'));
    }





    public function update(Request $request, $slug) {

        if (! $photo = photo::where('slug', $slug)->first())
        {
            abort(404, 'photo');
        }

        $validator = Validator::make($request->all(), [
            'img' => 'image|mimes:jpeg,jpg',
            'background' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'date' => 'nullable|max:255'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json(compact('error'), 400);
        }
        if($request->img) {
            // pas besoin
            // $photo->deleteImage();

            $photo->saveOptimizedImage(request()->img);
            // $imageName = time().'.'.request()->img->getClientOriginalExtension();
            // error_log(public_path().$photo->src);
            // request()->img->move(public_path('img'), $imageName);

            // $photo->src = '/img/'.$imageName;
        }
        $photo->background = $request->get('background');
        $photo->name = $request->get('name');
        $photo->date = $request->get('date');
        $photo->text = $request->get('text');
        $photo->exposed = $request->has('exposed');
        $photo->save();

        return redirect()->route('showGallery', $photo->gallery)->with('status', 'success')->with('content', 'Photo modifiée');
    }





    public function destroy(Request $request, $slug)
    {

        if (! $photo = photo::where('slug', $slug)->first())
        {
            abort(404, 'photo');
        }
        $photo->deleteImage();
        $photo->delete();
        return redirect()->route('showGallery', $photo->gallery)->with('status', 'success')->with('content', 'Photo supprimée');
    }



}
