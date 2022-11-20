<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('articles.index', [
            'articles' => Article::all()
        ]);
    }
}
