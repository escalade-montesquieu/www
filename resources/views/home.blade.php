<x-app-layout>
    <div class="container flex flex-col gap-20">
        <article class="relative -mt-20 pt-20 pb-10 before:-z-10 before:absolute before:inset-0 before:bg-white-medium before:scale-x-400 before:rotate-3">
            <h1 class="text-h1">Lycée Montesquieu</h1>
            <h2 class="text-h2">Section Escalade</h2>
        </article>
        <article class="relative before:-z-10 py-8 before:absolute before:inset-0 before:bg-white-medium before:scale-x-400 before:-rotate-3">
            <h2 class="text-h2 mb-10">Articles</h2>
            <section class="flex flex-col gap-10">
                @foreach($articles as $article)
                    <x-article-card :article="$article"/>
                @endforeach
                <a href="{{ route('articles') }}" class="btn-cta-tertiary">Tout voir</a>
            </section>
        </article>
        <article>
            <h2 class="text-h2 mb-4">Évènements à venir</h2>
            <section class="flex flex-col gap-4">
                @foreach($incomingEvents as $event)
                    <livewire:event-card :event="$event"/>
                @endforeach
                <a href="{{ route('events') }}" class="btn-cta-secondary">Tout voir</a>
            </section>
        </article>
    </div>
</x-app-layout>
