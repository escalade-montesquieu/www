<x-app-layout>
    <div class="container flex flex-coool gap-20">
        <article
            class="relative -mt-20 pt-20 pb-10 before:-z-10 before:absolute before:inset-0 before:bg-white-medium before:scale-x-400 before:rotate-3">
            <h1 class="text-h1">Lycée Montesquieu</h1>
            <h2 class="text-h2">Section Escalade</h2>
        </article>
        <article
            class="relative space-y-10 before:-z-10 py-8 before:absolute before:inset-0 before:bg-white-medium before:scale-x-400 before:-rotate-3">
            <h2 class="text-h2">Articles</h2>
            <livewire:articles.display-list :onlyOnHomepage="true"/>
            <a href="{{ route('articles') }}" class="btn-cta-tertiary">Tout voir</a>
        </article>
        <article class="space-y-10">
            <h2 class="text-h2">Évènements à venir</h2>
            <livewire:events.display-list :onlyIncoming="true"/>
            <a href="{{ route('events') }}" class="btn-cta-secondary">Tout voir</a>
        </article>
    </div>
</x-app-layout>
