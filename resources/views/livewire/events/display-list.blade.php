<div x-data="{ showFilters : false }" class="flex flex-coool">
    @if(!$onlyIncoming)
    <button class="btn-cta-secondary" @click="showFilters = !showFilters">
        <span x-show="!showFilters">Ouvrir les filtres</span>
        <span x-show="showFilters">Fermer les filtres</span>
        <x-heroicon-o-filter class="icon"/>
    </button>
    <section class="flex flex-coool" x-show="showFilters">
        <label for="eventCategoryId" class="mt-2">Catégorie</label>
        <select wire:model="eventCategoryId" id="eventCategoryId" name="eventCategoryId" class="input">
            <option value="">Toutes</option>
            @foreach($eventCategories as $eventName => $eventId)
                <option value="{{ $eventId }}">{{ $eventName }}</option>
            @endforeach
        </select>

        <label for="orderBy" class="mt-2">Ordonner par</label>
        <select wire:model="orderBy" id="orderBy" name="orderBy" class="input" >
            <option value="desc">Récent d'abord</option>
            <option value="asc">Ancien d'abord</option>
        </select>
    </section>
    @endif
    <section class="flex flex-coool gap-4">
        @foreach($this->eventDates as $date=>$events)
            <h3 class="text-h3 mt-5">{{ \Carbon\Carbon::parse($date)->translatedFormat('j F Y') }}</h3>
            @foreach($events as $event)
                @livewire('events.card', ['event' => $event], key($event->id))
            @endforeach
        @endforeach
    </section>
</div>
