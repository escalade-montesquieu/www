<x-app-layout>
    @section('title', 'Évènements')
    @section('description', 'Retrouvez et participez aux sorties grimpes du lycée. Falaise, Arkose, camping, etc.')

    <article class="container flex flex-coool gap-4 mt-10 lg:mt-32">
        {{ Breadcrumbs::render('events') }}
        <header>
            <h1 class="text-h1 mb-2">Évènements</h1>
            <p>Retrouvez et participez aux sessions organisées.</p>
        </header>
        <livewire:events.horizontal-list/>
    </article>
</x-app-layout>
