<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Jadwal Ujian</h2>
    </x-slot>

    <x-form-card :action="route('admin.ujian.update', $ujian)" method="PUT">
        @include('ujian._form')
    </x-form-card>
</x-app-layout>