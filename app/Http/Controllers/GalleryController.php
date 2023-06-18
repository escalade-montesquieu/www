<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class GalleryController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('galleries.index', [
            'galleries' => Gallery::ordered()->get()
        ]);
    }

    public function show(Gallery $gallery): Factory|View|Application
    {
        return view('galleries.show', [
            'gallery' => $gallery
        ]);
    }
}
