@props(['link'])
<a
    href="{{ $link ?? url()->previous() }}"
    {{ $attributes->merge(['class' => 'text-cta text-blue-medium']) }}>
    Retour
</a>
