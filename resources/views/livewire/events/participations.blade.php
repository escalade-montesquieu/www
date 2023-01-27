<section class="flex flex-coool gap-4">
    <h3 class="text-h3">Matériel emprunté</h3>

    <section class="flex flex-coool gap-2 p-4 rounded-lg bg-white-medium">
        <span>{{ $event->shoes_needed }} chaussons</span>
        <span>{{ $event->harnesses_needed }} baudriers</span>
    </section>

    <h3 class="text-h3">Participants</h3>

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
    @foreach($event->participants as $participant)
        @if($participant->id !== auth()?->user()?->id)
            <article class="bg-white-medium rounded-lg p-4 flex gap-4 items-start">
                <a href="{{ route('profile.show', $participant) }}">
                    <img src="{{ $participant->avatar }}" class="avatar-big" alt=" ">
                </a>
                <section class="flex flex-col gap-1">
                    <header>
                        <a class="text-h4"
                           href="{{ route('profile.show', $participant) }}">{{ $participant->name }}</a>
                    </header>
                    <span class="text-label">
                            @if($participant->rent_harness)
                            Emprunte un baudrier
                        @else
                            Possède son baudrier
                        @endif
                        </span>
                    <span class="text-label">
                        @if($participant->rent_shoes)
                            Emprunt des chaussons T{{ $participant->rent_shoes }}
                        @else
                            Possède ses chaussures
                        @endif
                        </span>
                </section>
            </article>
        @endif
    @endforeach
</section>
