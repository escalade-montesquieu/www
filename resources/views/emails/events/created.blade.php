{{--@formatter:off--}}
<x-mail::message>
# Nouvel évènement le {{ \Carbon\Carbon::parse($event->datetime)->translatedFormat('j F Y') }}

## {{ $event->title }}
<p><strong>
{{ $event->eventCategory->title }} -
@if($event->max_places)
{{ $event->max_places }} places
@else
Places illimités
@endif
</strong></p>

@if($event->content)
### Quoi?
<p>{{ $event->content }}</p>
@endif

@if($event->location)
### Où?
<p><a href="{{ $event->locationMapsLink }}">{{ $event->location }}</a></p>
@endif

<x-mail::button :url="route('events.show', $event)">
    Voir l'évènement
</x-mail::button>

Bonne journée,<br>
{{ config('app.name') }}
</x-mail::message>
