<x-app-layout>
    <article class="container flex flex-col gap-10">
        <header>
            <h1 class="text-h1 mb-2">Évènements</h1>
            <p>Retrouvez et participez aux sessions organisées.</p>
        </header>
        <section class="flex flex-col gap-4">
            @foreach($events as $event)
                <livewire:event-card :event="$event"/>
            @endforeach
        </section>
    </article>
</x-app-layout>
