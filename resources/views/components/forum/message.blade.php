<article class="flex flex-row gap-4 @if($message->isSentBySelf) justify-end @endif">
    @unless($message->isSentBySelf)
        <img class="h-8 w-8" src="{{ $message->user->avatar }}">
    @endif

    <article class="w-4/5">
        @unless($message->isSentBySelf)
            <label class="text-label">{{ $message->user->username }}</label>
        @endif
        <p class="bg-white-medium p-4 rounded-lg">{{ $message->content }}</p>
    </article>
</article>
