@props(['variant' => 'primary'])

@php
    $styles = [
        'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700',
        'secondary' => 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50',
    ];
@endphp

<a {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 ' . ($styles[$variant] ?? $styles['primary'])]) }}>
    {{ $slot }}
</a>