<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Buat Pengumuman</h2>
    </x-slot>

    <x-form-card :action="route('admin.pengumuman.store')">
        @include('pengumuman._form')
    </x-form-card>
</x-app-layout>