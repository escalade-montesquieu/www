<section class="flex flex-col gap-8 h-screen">
    <section class="grid grid-cols-7 text-center sticky top-0">
        <button wire:click="previousWeek()" class="col-span-1">
            <x-heroicon-o-chevron-double-left class="icon mx-auto"/>
        </button>
        <span class="col-span-5 capitalize">{{ $period }}</span>
        <button wire:click="nextWeek()" class="col-span-1">
            <x-heroicon-o-chevron-double-right class="icon mx-auto"/>
        </button>
    </section>
    <section class="text-center h-full">
        <section class="grid grid-cols-7 uppercase divide-x divide-white-dark">
            @foreach ($days as $day)
                <article class="flex flex-col pb-4">
                    <span class="text-sm font-thin">{{ substr($day['day']->translatedFormat('l'), 0, 1) }}</span>
                    <span>{{ $day['day']->day }}</span>
                </article>
            @endforeach
        </section>
        <section class="grid grid-cols-7 divide-x divide-white-dark h-full">
            @foreach ($days as $day)
                @include('livewire.events.partials.week-calendar-day')
            @endforeach
        </section>
    </section>
</section>
