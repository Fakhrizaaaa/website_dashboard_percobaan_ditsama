<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Tambah Jadwal Perkuliahan</h2>
    </x-slot>

    <x-form-card :action="route($prefix.'.perkuliahan.store')">
        @include('perkuliahan._form')
    </x-form-card>
</x-app-layout>