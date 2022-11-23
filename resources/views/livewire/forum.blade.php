<div wire:poll class="h-full overflow-x-hidden flex flex-coool gap-2">
    <section id="forumMessagesList" class="h-full flex-shrink-1 overflow-y-auto flex flex-coool gap-8 py-16">
        @forelse($messages as $message)
            <x-forum.message :message="$message"/>
        @empty
            <span>Pas de message pour l'instant</span>
        @endforelse
    </section>

    <section class="flex flex-row gap-2 mb-4 bg-white-medium rounded-xl">
        <input class="w-full input" placeholder="Votre message..." wire:model="writingMessage"
               wire:keydown.enter="sendWritingMessage">
        <button class="btn-cta-tertiary" wire:click="sendWritingMessage">Envoyer</button>
    </section>
</div>

