<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-indigo-600 mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 mb-6">Area khusus pengajaran dan pengampuan mata kuliah.</p>

                <!-- Grid Menu Dosen -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- 1. Kelola Mata Kuliah (sudah jadi link) -->
                    <a href="{{ route('dosen.mata-kuliah.index') }}" class="block p-5 bg-indigo-50 border border-indigo-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-indigo-800 text-lg mb-1">1. Kelola Mata Kuliah</h4>
                        <p class="text-sm text-gray-600 mb-3">Tambah dan atur mata kuliah yang kamu ampu.</p>
                        <span class="inline-block px-3 py-1 bg-indigo-600 text-white text-xs font-semibold rounded">Akses Pengampu</span>
                    </a>

                    <!-- 2. Kelola Perkuliahan -->
                    <a href="{{ route('dosen.perkuliahan.index') }}" class="block p-5 bg-teal-50 border border-teal-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-teal-800 text-lg mb-1">2. Kelola Perkuliahan</h4>
                        <p class="text-sm text-gray-600 mb-3">Atur jadwal kuliah (hari, jam, ruangan) untuk mata kuliahmu.</p>
                        <span class="inline-block px-3 py-1 bg-teal-600 text-white text-xs font-semibold rounded">Akses Pengampu</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>