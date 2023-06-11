<x-app-layout>
    @section('title', $event->title)
    @section('description', $event->description)

    <section class="container mt-10 lg:mt-32 space-y-4">
        {{ Breadcrumbs::render('event', $event) }}

        <h1 class="text-h1">{{ $event->title }}</h1>
        <h2 class="text-h2">Le {{ $event->datetime->translatedFormat('j F Y') }}</h2>
    </section>
    <section class="container mt-16 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-16">
        <section class="col-span-1 lg:col-span-2 flex flex-coool gap-16">
            @if($event->description)
                <article class="space-y-2 lg:space-y-4">
                    <h3 class="text-h3">Description</h3>

                    <p>
                        {{ $event->description }}
                    </p>
                </article>
            @endif

            @if($event->location)
                <article class="space-y-2 lg:space-y-4">
                    <h3 class="text-h3">Emplacement</h3>
                    <p>{{ $event->location }}</p>
                    <iframe class="w-full aspect-video rounded-lg overflow-hidden" frameborder="0"
                            src="{{ $event->iframe_maps_link }}"></iframe>
                </article>
            @endif
        </section>
        <section class="col-span-1">
            <livewire:events.participations :event="$event"/>
        </section>
    </section>

</x-app-layout>
