@props(['disabled' => false, 'value' => null])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white-medium rounded-lg border-none focus:border-blue-medium focus:ring focus:ring-blue-medium focus:ring-opacity-50']) !!}>{{ $value ?? $slot  }}</textarea>
