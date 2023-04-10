<div x-data="{ showFilters : false }" class="flex flex-coool gap-16">
    @if(!$onlyIncoming)
        <section class="sticky top-header bg-white-light py-4 -my-4 grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-16">
            <button class="col-span-full btn-cta-secondary lg:hidden" @click="showFilters = !showFilters">
                <span x-show="!showFilters">Ouvrir les filtres</span>
                <span x-show="showFilters">Fermer les filtres</span>
                <x-heroicon-o-filter class="icon"/>
            </button>
            <div class="col-span-full lg:col-span-4" :class="{'max-lg:hidden': !showFilters}">
                <label for="eventCategoryId" class="mt-2">Catégorie</label>
                <select wire:model="eventCategoryId" id="eventCategoryId" name="eventCategoryId" class="input w-full">
                    <option value="">Toutes</option>
                    @foreach($eventCategories as $eventName => $eventId)
                        <option value="{{ $eventId }}">{{ $eventName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-full lg:col-span-4" :class="{'max-lg:hidden': !showFilters}">
                <label for="orderBy" class="mt-2">Ordonner par</label>
                <select wire:model="orderBy" id="orderBy" name="orderBy" class="input w-full">
                    <option value="desc">Récent d'abord</option>
                    <option value="asc">Ancien d'abord</option>
                </select>
            </div>
        </section>
    @endif
    @if(count($this->eventDates))
        <section class="flex flex-coool gap-16">
            @foreach($this->eventDates as $date=>$events)
                <article class="flex flex-coool gap-4">
                    <h3 class="text-h3">{{ \Carbon\Carbon::parse($date)->translatedFormat('j F Y') }}</h3>

                    <section
                        class="grid grid-cols-1 @if(!$onlyIncoming) lg:grid-cols-2 xl:grid-cols-3 @endif gap-8 lg:gap-16">
                        @foreach($events as $event)
                            @livewire('events.card', ['event' => $event], key($event->id))
                        @endforeach
                    </section>
                </article>
            @endforeach
        </section>
    @else
        <article class="lg:sticky lg:top-36 space-y-4 lg:space-y-8">
            <img class="h-auto md:h-40 max-md:w-2/3 mt-4" src="{{ asset('assets/svg/camping.svg') }}" alt=" "/>
            <p>Aucun évènement prévu pour le moment. Vous avez une idée d'évènement ? Partagez-la sur le forum !</p>
        </article>
    @endif
</div>
