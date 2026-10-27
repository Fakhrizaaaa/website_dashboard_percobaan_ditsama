@props(['active' => false, 'icon'])

@php
    $classes = $active
        ? 'bg-indigo-600 text-white shadow-sm'
        : 'text-slate-300 hover:bg-slate-800 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => 'group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition ' . $classes]) }}>
    <x-icon :name="$icon" class="h-5 w-5 shrink-0 {{ $active ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" />
    <span class="truncate">{{ $slot }}</span>
</a>