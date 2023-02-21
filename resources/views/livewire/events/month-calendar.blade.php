<section class="flex flex-col gap-8">
    <section class="grid grid-cols-7 text-center">
        <button wire:click="previousMonth()" class="col-span-1">
            <x-heroicon-o-chevron-double-left class="icon mx-auto"/>
        </button>
        <span class="col-span-5 capitalize">{{ $period }}</span>
        <button wire:click="nextMonth()" class="col-span-1">
            <x-heroicon-o-chevron-double-right class="icon mx-auto"/>
        </button>
    </section>
    <table class="text-center">
        <thead>
        <tr class="grid grid-cols-7 pb-4">
            <th>L</th>
            <th>M</th>
            <th>M</th>
            <th>J</th>
            <th>V</th>
            <th>S</th>
            <th>D</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-white-dark">
        @foreach ($weeks as $days)
            <tr class="grid grid-cols-7 divide-x divide-white-dark">
                @foreach ($days as $day)
                    @include('livewire.events.partials.month-calendar-day')
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</section>
