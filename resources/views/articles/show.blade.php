<x-app-layout>
    <article class="container flex flex-coool gap-4 mt-10 lg:mt-32">
        <x-back-link :link="route('articles')" text="Retour aux articles"/>
        <header>
            <h2 class="text-h2 mb-2">{{ $article->title }}</h2>
        </header>
        <section class="flex flex-coool gap-10">
            {{ $article->content }}
        </section>
    </article>
</x-app-layout>
