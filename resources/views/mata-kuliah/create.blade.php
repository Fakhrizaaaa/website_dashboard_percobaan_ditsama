<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Tambah Mata Kuliah</h2>
    </x-slot>

    <x-form-card :action="route($prefix.'.mata-kuliah.store')">
        @include('mata-kuliah._form')
    </x-form-card>
</x-app-layout>