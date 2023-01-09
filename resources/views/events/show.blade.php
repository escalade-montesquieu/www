<x-app-layout>
    <article class="container flex flex-coool gap-4 mt-10 lg:mt-32">
        <header>
            <h1 class="text-h1 mb-2">Détail d'un évènement</h1>
        </header>
        <livewire:events.card :event="$event"/>
    </article>
</x-app-layout>
