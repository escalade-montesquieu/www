{{--@formatter:off--}}
<x-mail::message>
# {{ $message->user->username }} vous a mentionné dans un message

## Le message
<p>{!! $message->htmlWithMentions !!}</p>

<x-mail::button :url="route('forum')">
Répondre
</x-mail::button>

Bonne journée,<br>
{{ config('app.name') }}
</x-mail::message>
