<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Index\Messages;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/events', [EventController::class, 'index'])->name('events');

Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries');
Route::get('/gallery/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');


Route::middleware('auth')->group(function () {
    Route::get('/forum', [ForumController::class, 'show'])->name('forum');
});

require __DIR__ . '/auth.php';
