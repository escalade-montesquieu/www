<x-app-layout>
    <article class="container flex flex-coool gap-10">
        <a class="text-cta text-blue-medium" href="{{ url()->previous() }}">Retour</a>
        <header>
            <h2 class="text-h2 mb-2">{{ $article->title }}</h2>
        </header>
        <section class="flex flex-coool gap-10">
            {{ $article->content }}
        </section>
    </article>
</x-app-layout>
