<article class="relative flex flex-coool gap-2 items-start">
    @if($article->firstNotLinkResource)
        <x-articles.resource :hide-title="true" :resource="$article->firstNotLinkResource"/>
    @endif
    <header>
        <h3 class="text-h3">
            @if($article->link)
                <a class="hover:underline" target="_blank" rel="noopener noreferrer"
                   href="{{ $article->link }}">
                    <span>{{ $article->title }}</span>
                    <x-heroicon-o-external-link class="inline h-6 w-6 align-baseline"/>
                    <span class="sr-only">(Lien externe)</span>
                </a>
            @elseif($article->firstResource && $article->firstResource['type'] === \App\Enums\ArticleResourceType::YOUTUBE_VIDEO->value)
                <a class="hover:underline" target="_blank" rel="noopener noreferrer"
                   href="{{ $article->firstResource['data']['url'] }}">
                    {{ $article->title }}
                    <x-heroicon-o-external-link class="inline h-6 w-6 align-baseline"/>
                    <span class="sr-only">(Lien externe)</span>
                </a>
            @else
                {{ $article->title }}
            @endif
        </h3>
    </header>
    <section class="markdown">
        @markdown($article->content)
    </section>
    @foreach($article->linkResources as $resource)
        <x-articles.resource :resource="$resource"/>
    @endforeach
</article>
