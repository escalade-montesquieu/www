<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Index\Messages;
use App\Http\Livewire\ProfileEdition;
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

Route::get('/evenements', [EventController::class, 'index'])->name('events');
Route::get('/evenements/{event}', [EventController::class, 'show'])->name('events.show');

Route::middleware('auth')->group(function () {
    Route::get('/forum', [ForumController::class, 'show'])->name('forum');

    Route::get('/profil/edit', ProfileEdition::class)->name('profile.edit');
    Route::get('/profil/{user?}', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/galeries', [GalleryController::class, 'index'])->name('galleries');
    Route::get('/galeries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
});

require __DIR__ . '/auth.php';
