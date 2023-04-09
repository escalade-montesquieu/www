<x-app-layout>
    <section class="container mt-10 lg:mt-32 mb-6">
        <article class="col-span-full flex flex-coool gap-4 mb-16">
            {{ Breadcrumbs::render('article', $article) }}
            <header>
                <h2 class="text-h2">{{ $article->title }}</h2>
            </header>
            <section class="flex flex-coool gap-10 markdown">
                @markdown($article->content)
            </section>
        </article>
        <section
            class="items-end grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 lg:gap-16">
            @foreach($article->resources as $resource)
                <article>
                    @if($resource['data']['title'])
                        <h4 class="text-h4 mb-2">{{ $resource['data']['title'] }}</h4>
                    @endif
                    <x-articles.resource :resource="$resource"/>
                </article>
            @endforeach
        </section>
    </section>

</x-app-layout>
