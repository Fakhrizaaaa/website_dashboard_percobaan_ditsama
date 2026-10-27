{{-- Pemakaian: <x-table><x-slot name="head"><tr><th>..</th></tr></x-slot> ...baris... </x-table> --}}
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 text-sm [&_th]:px-6 [&_th]:py-3 [&_th]:text-left [&_td]:px-6 [&_td]:py-3.5">
        <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
            {{ $head }}
        </thead>
        <tbody class="divide-y divide-gray-100 text-gray-700">
            {{ $slot }}
        </tbody>
    </table>
</div>