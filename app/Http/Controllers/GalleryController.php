<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Support\Facades\Validator;
use Image;
use ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class GalleryController extends Controller
{

    public function index() {
        $galleries = gallery::all()->reverse();
        return view('photos.galleries', compact('galleries'));
    }




    public function show($slug) {
        if (! $gallery = gallery::where('slug', $slug)->first())
        {
            abort(404, 'gallery');
        }
        $photos = photo::where('gallery', $gallery->slug)->get()->reverse();

        return view('photos.gallery.show', compact('gallery', 'photos'));
    }





    public function create() {
        return view('photos.gallery.create');
    }




    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:gallery|string|max:255',
            'slug' => 'required|unique:gallery|string|max:255',
            'img' => 'required|image|mimes:jpeg,jpg',
        ]);
        if ($validator->fails()) {
            //on retourne l'erreur
            return back()->withInput()->withErrors($validator);
        }

        // slug et nom name pour éviter les soucis avec les "/" (ca va chercher la photo dans un sous dossier après -> 404)

        // $imageName = $request->get('slug').'.'.request()->img->getClientOriginalExtension();
        // $destinationPath = public_path('preview');

        // $img = Image::make(request()->img->getRealPath());
        // $img->resize($gallery->preview_resize, $gallery->preview_resize, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath.'/'.$imageName);

        // ImageOptimizer::optimize($destinationPath.'/'.$imageName);
        // $destinationPath = public_path('/images');
        // $image->move($destinationPath, $input['imagename']);
        // request()->img->move(, $imageName);


        $gallery = gallery::create([
            'name' => $request->get('name'),
            'slug'  => $request->get('slug'),
            'preview'  => 'temp',
            'text' => $request->get('text'),
        ]);
        $gallery->saveOptimizedPreview(request()->img);
        $gallery->save();
        return redirect()->route('galleries')->with('status', 'success')->with('content', 'Gallerie ajoutée');
    }




    public function edit($slug) {
        if (! $gallery = gallery::where('slug', $slug)->first())
        {
            abort(404, 'gallery');
        }
        return view('photos.gallery.edit', compact('gallery'));
    }




    public function update(Request $request, $slug) {
        if (! $gallery = gallery::where('slug', $slug)->first())
        {
            abort(404, 'gallery');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,jpg',
        ]);
        if ($validator->fails()) {
            //on retourne l'erreur
            return back()->withInput()->withErrors($validator);
        }

        if($request->img) {
            // File::delete(public_path().$gallery->preview);
            // $gallery->deletePreview();

            $gallery->saveOptimizedPreview(request()->img);
            // slug et nom name pour éviter les soucis avec les "/" (ca va chercher la photo dans un sous dossier après -> 404)
            // $imageName = $gallery->slug.'.'.request()->img->getClientOriginalExtension();
            // $destinationPath = public_path('preview');

            // $img = Image::make(request()->img->getRealPath());
            // $img->resize($gallery->preview_resize, $gallery->preview_resize, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destinationPath.'/'.$imageName);

            // $gallery->preview = '/preview/'.$imageName;
        }
        $gallery->name = $request->get('name');
        $gallery->text = $request->get('text');
        $gallery->save();


        $gallery = $gallery::where('slug', $slug)->first();
        return redirect()->route('showGallery', $gallery->slug)->with('status', 'success')->with('content', 'Modifications enregistrées');
    }





    public function destroy(Request $request, $slug)
    {
        if (! $gallery = gallery::where('slug', $slug)->orWhere('name', $slug)->first())
        {
            abort(404, 'gallery');
        }
        $gallery->deletePreview();
        $gallery->delete();
        return redirect()->route('galleries')->with('status', 'success')->with('content', 'Gallerie supprimée');
    }




}
