<article class="col-span-full lg:col-span-6 xl:col-span-4 flex flex-coool gap-2">
    <header>
        <h3 class="text-h3">
            {{ $article->title }}
        </h3>
    </header>
    <p>{{ $article->content }}</p>
    <a class="text-cta link" href="{{ route('articles.show', $article) }}">
        Lire plus
    </a>
</article>
