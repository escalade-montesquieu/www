@if($message->htmlWithMentions !== "")
    <article class="message flex flex-row gap-4 items-start @if($message->isSentBySelf) justify-end @endif">
        @unless($message->isSentBySelf)
            <a class="mt-2" href="{{ route('profile.show', $message->user) }}">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ asset($message->user->avatar) }}" alt=" ">
            </a>
        @endif

        <article class="w-4/5 lg:w-3/5">
            @unless($message->isSentBySelf)
                <label class="text-label">{{ $message->user->username }}</label>
            @endif
            <p class="bg-white-medium p-4 rounded-lg lg:rounded-xl">{!! $message->htmlWithMentions !!}</p>
        </article>
    </article>
@endif
