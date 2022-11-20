<x-app-layout>
    <article class="container flex flex-col gap-10">
        <header>
            <h1 class="text-h1 mb-2">Articles</h1>
            <p>Retrouvez des ressources, vidéos, évènements à suivre.</p>
        </header>
        <section class="flex flex-col gap-10">
            @foreach($articles as $article)
                <x-article-card :article="$article"/>
            @endforeach
        </section>
    </article>
</x-app-layout>
