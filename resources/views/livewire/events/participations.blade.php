<section class="flex flex-coool gap-16">
    @if(auth()->check() && auth()->user()->role === \App\Enums\UserRole::ADMIN)
        <article class="space-y-2 lg:space-y-4">
            <header>
                <h3 class="text-h3">Matériel emprunté</h3>
            </header>
            <section class="flex flex-coool gap-2">
                <article class="flex gap-4 items-center p-4 rounded-lg bg-white-medium">
                    <header>
                        <span class="text-h3">{{ $event->harnesses_needed }}</span>
                    </header>
                    <span class="font-bold">baudriers</span>
                </article>
                @forelse($event->shoes_needed as $shoesSize => $shoes)
                    <article class="flex gap-4 items-center p-4 rounded-lg bg-white-medium">
                        <header>
                            <span class="text-h3">{{ $shoes->count() }}</span>
                        </header>
                        <span>paire de <b class="font-bold">T{{ $shoesSize }}</b></span>
                    </article>
                @empty
                    <article class="flex gap-4 items-center p-4 rounded-lg bg-white-medium">
                        <header>
                            <span class="text-h3">0</span>
                        </header>
                        <span><b>paire empruntée</b></span>
                    </article>
                @endforelse
            </section>
        </article>
    @endif

    <article class="space-y-2 lg:space-y-4">
        <header>
            <h3 class="text-h3">Participants</h3>
            @if($event->max_places > -1)
                <p>{{ $event->max_places-$event->participants->count() }} places restantes
                    sur {{ $event->max_places }}</p>
            @else
                <p>Places illimitées, {{ $event->participants->count() }} participants</p>
            @endif
        </header>

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
                                Emprunte des chaussons T{{ $participant->rent_shoes }}
                            @else
                                Possède ses chaussures
                            @endif
                            </span>
                    </section>
                </article>
            @endif
        @endforeach
    </article>
</section>
