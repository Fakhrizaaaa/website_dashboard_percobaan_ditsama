<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Pengumuman</h2>
    </x-slot>

    <x-form-card :action="route('admin.pengumuman.update', $pengumuman)" method="PUT">
        @include('pengumuman._form')
    </x-form-card>
</x-app-layout>