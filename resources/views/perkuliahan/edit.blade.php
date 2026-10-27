<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Jadwal Perkuliahan</h2>
    </x-slot>

    <x-form-card :action="route($prefix.'.perkuliahan.update', $perkuliahan)" method="PUT">
        @include('perkuliahan._form')
    </x-form-card>
</x-app-layout>