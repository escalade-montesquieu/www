<article class="flex flex-coool gap-4 p-4 bg-white-medium rounded-2xl">
    <header>
        <h3 class="text-h3">
            <a href="{{ route('events.show', $event) }}">
                {{ $event->title }}
            </a>
        </h3>
        <p>{{ $event->eventCategory->title }}</p>
        <p>
            @if($event->max_places)
                <span>{{ $event->max_places }} places</span>
            @else
                <span>Places illimités</span>
            @endif
            <span>- {{ $event->participants->count() }} @if($event->participants->count()>1)
                    participants
                @else
                    participant
                @endif </span>
        </p>
    </header>

    <p>{{ $event->description }}</p>

    @if($event->isPast)
        <section class="flex flex-row gap-4 p-4 rounded-lg bg-white-dark text-black-dark text-label items-center">
            <x-heroicon-o-exclamation class="inline icon"/>
            L'évènement est terminé
        </section>
    @elseif($event->is_user_participating)
        <section class="flex flex-coool gap-2 p-4 rounded-lg bg-green-light text-green-dark">
            <h4 class="text-h4">
                Vous participez
                <x-heroicon-o-check class="inline icon"/>
            </h4>
            <p>
                {{ auth()->user()->climbing_stuff_sentence }}
            </p>
            <button wire:click="removeParticipation" class="text-cta text-black-dark mr-auto">
                Annuler ma participation
            </button>
        </section>
    @elseif($event->is_full)
        <section class="flex flex-row gap-4 p-4 rounded-lg bg-white-dark text-black-dark text-label items-center">
            <x-heroicon-o-exclamation class="inline icon"/>
            Toutes les places sont prises
        </section>
    @else
        <button wire:click="addParticipation" class="btn-success-primary mr-auto">
            Participer
            <x-heroicon-o-hand class="icon"/>
        </button>
    @endif
</article>
