@props(['value'])

<label {{ $attributes->merge(['class' => 'text-body']) }}>
    {{ $value ?? $slot }}
</label>
