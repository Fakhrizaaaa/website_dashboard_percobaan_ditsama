@props(['label', 'value', 'hint' => null, 'small' => false])

<x-card class="p-5">
    <p class="text-sm text-gray-500">{{ $label }}</p>
    <p class="mt-1 text-gray-900 {{ $small ? 'text-base font-semibold' : 'text-2xl font-bold' }}">{{ $value }}</p>
    @if ($hint)
        <p class="mt-1 text-xs text-gray-500">{{ $hint }}</p>
    @endif
</x-card>