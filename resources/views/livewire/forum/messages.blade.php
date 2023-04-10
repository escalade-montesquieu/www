<section wire:poll id="forumMessagesList"
         class="relative h-full flex-shrink-1 overflow-y-auto flex flex-coool gap-8 py-16 lg:-mx-4 lg:px-4">
    <p class="text-center hidden" id="forumOlderMessageLoadingIndicator">
        Chargement...
    </p>
    @forelse($messages as $message)
        <x-forum.message :message="$message"/>
    @empty
        <span>Pas de message pour l'instant</span>
    @endforelse

    @if($messages->last()?->seenByOtherThanLoggedUser->count())
        <button wire:click="showSeenPopup"
                class="ml-auto flex flex-row items-center justify-end pr-4 gap-2 text-label text-black-medium">
            <span>Vu par</span>
            <div class="flex flex-row pl-2">
                @foreach($messages->last()->seenByOtherThanLoggedUser->take(5) as $user)
                    <div class="-ml-2">
                        <img class="avatar " src="{{ $user->avatar }}" alt="{{ $user->username }}">
                    </div>
                @endforeach
            </div>
            @if($messages->last()->seenByOtherThanLoggedUser->count() > 5)
                <span>+ {{ $messages->last()->seenByOtherThanLoggedUser->count() - 5 }}</span>
            @endif
        </button>
    @endif

    @if($isSeenPopupVisible)
        <section class="fixed z-50 top-0 left-0 h-screen w-full flex flex-col justify-center items-center">
            <div class="container h-full py-20 flex flex-col justify-center">
                <div wire:click="hideSeenPopup" class="absolute top-0 left-0 h-screen w-full bg-black-dark/30"></div>
                <article class="max-h-full z-10 bg-white-light p-8 rounded-lg flex flex-col gap-8 mx-auto w-10/12">
                    <div class="flex justify-between items-center">
                        <h2 class="text-h2">Message vu par </h2>
                        <button wire:click="hideSeenPopup">
                            <x-heroicon-o-x class="h-8 w-8"/>
                        </button>
                    </div>
                    <div class="flex flex-col items-start gap-4 overflow-auto">
                        @foreach($messages->last()->seenByOtherThanLoggedUser as $user)
                            <a href="{{ route('profile.show', $user) }}" class="flex gap-4 items-center">
                                <img class="avatar" src="{{ $user->avatar }}" alt=" ">
                                <span>{{ $user->username }}</span>
                            </a>
                        @endforeach
                    </div>
                </article>
            </div>
        </section>
    @endif
</section>


