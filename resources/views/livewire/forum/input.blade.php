<section class="flex flex-row gap-2 mb-4 bg-white-medium rounded-xl">
    <input class="w-full input" placeholder="Votre message..." wire:model="message"
           wire:keydown.enter="sendMessage">
    <button class="btn-cta-tertiary" wire:click="sendMessage">Envoyer</button>
</section>
