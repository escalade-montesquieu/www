{{--@formatter:off--}}
<x-mail::message>
# Évènement à venir le {{ \Carbon\Carbon::parse($event->datetime)->translatedFormat('j F Y') }}

## Vous participez à {{ $event->title }}
<strong>
{{ $event->eventCategory->name }} -
@if($event->max_places)
{{ $event->max_places }} places
@else
Places illimités
@endif
</strong>

<p>{{ $event->content }}</p>

<x-mail::button :url="route('events.show', $event)">
Voir l'évènement
</x-mail::button>

Bonne journée,<br>
{{ config('app.name') }}
</x-mail::message>
