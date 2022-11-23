<section wire:poll id="forumMessagesList"
         class="h-full flex-shrink-1 overflow-y-auto flex flex-coool gap-8 py-16">
    @forelse($messages as $message)
        <x-forum.message :message="$message"/>
    @empty
        <span>Pas de message pour l'instant</span>
    @endforelse
</section>

