<article class="overflow-hidden">
    <div class="flex gap-2 py-4">
        <button class="btn-cta-secondary" @click="scrollToNextEvent()">
            Aller à aujourd'hui
        </button>
    </div>

    <section class="flex overflow-scroll -mx-6 pb-10 snap-x" id="events-list">
        @foreach($eventDates->toArray() as $date=>$events)
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
            const nextEventEl = document.querySelector('[data-past="false"]');

            if (!nextEventEl) {
                return
            }

            scrollElToCenter(nextEventEl);

            if (focus) {
                nextEventEl.querySelector('a').focus();
            }
        }

        scrollToNextEvent(false);
    </script>
</article>
