<article class="flex flex-coool gap-2 items-start">
    @if($article->firstResource)
        <x-articles.resource :resource="$article->firstResource"/>
    @endif
    <header>
        <h3 class="text-h3">
            <a class="hover:underline" href="{{ route('articles.show', $article) }}">
                {{ $article->title }}
            </a>
        </h3>
    </header>
    <section class="markdown">
        @markdown($article->content)
    </section>
</article>
