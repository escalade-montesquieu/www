<article class="flex flex-coool gap-4 p-4 bg-white-medium rounded-2xl">
    <header>
        <h3 class="text-h3">
            {{ $event->title }}
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

    <p>{{ $event->content }}</p>

    @if($event->isPast)
        <section class="flex flex-row gap-4 p-4 rounded-lg bg-white-dark text-black-dark text-label">
            <x-heroicon-o-exclamation class="inline icon"/>
            L'évènement est terminé
        </section>
    @elseif(!$event->isUserParticipating)
        <button wire:click="addParticipation" class="btn-success-primary mr-auto">
            Participer
            <x-heroicon-o-hand class="icon"/>
        </button>
    @else
        <section class="flex flex-coool gap-2 p-4 rounded-lg bg-green-light text-green-dark">
            <h4 class="text-h4">
                Vous participez
                <x-heroicon-o-check class="inline icon"/>
            </h4>
            <p>
                {{ auth()->user()->climbingStuffSentence }}
            </p>
            <button wire:click="removeParticipation" class="text-cta text-black-dark mr-auto">
                Annuler ma participation
            </button>
        </section>

    @endif
</article>
