<section class="flex flex-row gap-2 mb-4 bg-white-medium rounded-xl relative overflow-visible">
    @if($this->mentionSuggestions)
        <section
            class="absolute -top-2 -translate-y-full bg-white-light max-h-52 w-full overflow-auto z-50 flex flex-col gap-2 p-2">

            @foreach($this->mentionSuggestions['special'] as $special)
                <button class="flex gap-2 items-center" wire:click="mentionUser('{{ $special['id'] }}')">
                    <div class="avatar"></div>
                    {{ $special['name'] }}
                </button>
            @endforeach
            @foreach($this->mentionSuggestions['users'] as $user)
                <button class="flex gap-2 items-center" wire:click="mentionUser('{{ $user->sluggedUsername }}')">
                    <img class="avatar" src="{{ $user->avatar }}" alt=" ">
                    {{ $user->sluggedUsername }}
                </button>
            @endforeach
        </section>
    @endif

    <input class="w-full input" id="forum-input" placeholder="Votre message..." wire:model="message"
           wire:keydown.enter="sendMessage">
    <button class="btn-cta-tertiary" wire:click="sendMessage">Envoyer</button>

    <script>
        window.addEventListener('forum.focus-input', () => {
            document.getElementById('forum-input').focus();
        })
    </script>
</section>
