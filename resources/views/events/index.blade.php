<x-app-layout>
    <article class="container flex flex-coool gap-4 mt-10 lg:mt-32">
        {{ Breadcrumbs::render('events') }}
        <header>
            <h1 class="text-h1 mb-2">Évènements</h1>
            <p>Retrouvez et participez aux sessions organisées.</p>
        </header>
    </article>
    <section class="container mt-16">
        <livewire:events.week-calendar/>
    </section>
</x-app-layout>
