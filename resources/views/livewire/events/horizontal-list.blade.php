<article class="overflow-hidden">
    <div class="flex max-md:flex-coool md:items-end gap-2 py-4">
        <div class="col-span-full lg:col-span-4" :class="{'max-lg:hidden': !showFilters}">
            <label for="eventCategoryId" class="mt-2">Catégorie</label>
            <select wire:model="eventCategoryId" id="eventCategoryId" name="eventCategoryId" class="input w-full">
                <option value="">Toutes</option>
                @foreach($eventCategories as $eventName => $eventId)
                    <option value="{{ $eventId }}">{{ $eventName }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn-cta-secondary" onclick="scrollToNextEvent()">
            Aller à aujourd'hui
        </button>
    </div>

    <section class="flex overflow-scroll -mx-6 pb-10 snap-x" id="events-list">
        @foreach($this->eventDates as $date=>$events)
            @php($parsedDate = \Carbon\Carbon::parse($date))
            <article class="flex flex-coool gap-4 mx-6 flex-none w-1/2 md:w-1/4 group snap-center"
                     data-past="{{ var_export($parsedDate->isPast(), true) }}">
                <div class="flex items-center -ml-6 -mr-14 py-4">
                    <div class="h-0.5 w-8 bg-white-dark opacity-0"></div>
                    @if($parsedDate->isPast())
                        <div class="z-10 h-4 aspect-square rounded-full bg-white-dark"></div>
                        <div class="h-0.5 w-full bg-white-dark group-[:last-child]:opacity-0"></div>
                    @else
                        <div class="z-10 h-4 aspect-square rounded-full bg-blue-medium"></div>
                        <div class="h-0.5 w-full bg-blue-medium group-[:last-child]:opacity-0"></div>
                    @endif
                </div>

                <h3 class="text-h3">{{ $parsedDate->translatedFormat('j F Y') }}</h3>

                <section class="flex flex-coool gap-8">
                    @foreach($events as $event)
                        <a class="btn-cta-secondary justify-start" href="{{ route('events.show', $event) }}">
                            {{ $event->title }}
                        </a>
                    @endforeach
                </section>
            </article>
        @endforeach
    </section>

    <script>
        function scrollElToCenter(el) {
            const parent = el.parentNode;

            parent.scrollLeft = el.offsetLeft - parent.offsetWidth / 2;
        }

        function scrollToNextEvent(focus = true) {
            const eventsListEl = document.getElementById('events-list');

            if (!eventsListEl) {
                return
            }

            const nextEventEl = document.querySelector('[data-past="false"]');

            if (!nextEventEl) {
                eventsListEl.scrollLeft = eventsListEl.scrollWidth
                return
            }

            scrollElToCenter(nextEventEl);

            if (focus) {
                nextEventEl.querySelector('a').focus();
            }
        }

        scrollToNextEvent(false);

        window.addEventListener('event-list:change', event => {
            scrollToNextEvent(false);
        })
    </script>
</article>
