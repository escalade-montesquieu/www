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
</section>


