<td>
    <article
        class="h-full items-center flex flex-col gap-1 px-1 py-2 hover:bg-gray-300 @if(!$day['withinMonth']) text-black-light font-thin @endif"
    >
        <header>
            {{ $day['day']->day }}
        </header>
        @foreach($day['events'] as $event)
            <a
                href="{{ route('events.show', $event) }}"
                title="{{ $event->title }}"
                class="w-full link text-sm whitespace-nowrap text-ellipsis overflow-hidden"
            >
                {{ $event->title }}
            </a>
        @endforeach
    </article>
</td>
