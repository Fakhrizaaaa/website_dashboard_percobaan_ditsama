@props(['href', 'title', 'desc', 'icon', 'color' => 'indigo'])

@php
    $colors = [
        'indigo' => 'bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100',
        'blue' => 'bg-blue-50 text-blue-600 group-hover:bg-blue-100',
        'emerald' => 'bg-emerald-50 text-emerald-600 group-hover:bg-emerald-100',
        'violet' => 'bg-violet-50 text-violet-600 group-hover:bg-violet-100',
        'amber' => 'bg-amber-50 text-amber-600 group-hover:bg-amber-100',
        'rose' => 'bg-rose-50 text-rose-600 group-hover:bg-rose-100',
        'teal' => 'bg-teal-50 text-teal-600 group-hover:bg-teal-100',
        'sky' => 'bg-sky-50 text-sky-600 group-hover:bg-sky-100',
        'orange' => 'bg-orange-50 text-orange-600 group-hover:bg-orange-100',
    ];
@endphp

<a href="{{ $href }}" class="group flex items-start gap-4 rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-indigo-300 hover:shadow-md">
    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl transition {{ $colors[$color] ?? $colors['indigo'] }}">
        <x-icon :name="$icon" class="h-6 w-6" />
    </div>
    <div>
        <h4 class="font-semibold text-gray-900">{{ $title }}</h4>
        <p class="mt-1 text-sm text-gray-500">{{ $desc }}</p>
    </div>
</a>