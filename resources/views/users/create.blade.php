<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Tambah User</h2>
    </x-slot>

    <x-form-card :action="route('admin.users.store')">
        @include('users._form')
    </x-form-card>
</x-app-layout>