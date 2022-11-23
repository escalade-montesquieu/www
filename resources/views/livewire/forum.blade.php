<div class="overflow-x-hidden flex flex-coool gap-2" @message-send.window="e()">
    <section wire:poll class="flex-shrink-1 overflow-y-auto flex flex-coool gap-8 py-16 scroll-at-bottom">
        @foreach($messages as $message)
            <x-forum.message :message="$message"/>
        @endforeach
    </section>

    <section class="flex flex-row gap-2 mb-4 bg-white-medium rounded-lg">
        <input class="w-full input" placeholder="Votre message..." wire:model="writingMessage"
               wire:keydown.enter="sendWritingMessage">
        <button class="btn-cta-tertiary" wire:click="sendWritingMessage">Envoyer</button>
    </section>
</div>

