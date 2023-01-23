<x-app-layout>
    <article class="container flex flex-coool gap-4 mt-10 lg:mt-32">
        {{ Breadcrumbs::render('article', $article) }}
        <header>
            <h2 class="text-h2 mb-2">{{ $article->title }}</h2>
        </header>
        <section class="flex flex-coool gap-10">
            {{ $article->content }}
        </section>
        <section class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-16 lg:gap-16">
            @foreach($article->resources as $resource)
                <x-articles.resource :resource="$resource"/>
            @endforeach
        </section>
    </article>
</x-app-layout>
