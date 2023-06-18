@props(['link', 'text'])
<a
    href="{{ $link ?? url()->previous() }}"
    {{ $attributes->merge(['class' => 'text-cta text-blue-medium']) }}>
    {{ $text ?? 'Retour' }}
</a>
