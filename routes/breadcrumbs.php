<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Article;
use App\Models\Gallery;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Accueil', route('home'));
});

// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Articles
Breadcrumbs::for('articles', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Articles', route('articles'));
});

// Home > Articles > {Article}
Breadcrumbs::for('article', function (BreadcrumbTrail $trail, Article $article) {
    $trail->parent('articles');
    $trail->push($article->title, route('articles.show', $article));
});

// Home > Events
Breadcrumbs::for('events', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Évènements', route('events'));
});

// Home > Galleries
Breadcrumbs::for('galleries', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Galeries', route('galleries'));
});

// Home > Galleries > {Galerie}
Breadcrumbs::for('gallery', function (BreadcrumbTrail $trail, Gallery $gallery) {
    $trail->parent('galleries');
    $trail->push($gallery->title, route('galleries.show', $gallery));
});

// Home > Profile
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Profil', route('profile.show'));
});

