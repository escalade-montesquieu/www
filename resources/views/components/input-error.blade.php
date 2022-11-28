@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-label text-red-medium space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
