<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa Perpustakaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-indigo-600 mb-2">Halo, {{ Auth::user()->name }} (Siswa)!</h3>
                <p class="text-gray-600 mb-4">Akses Anda terbatas untuk melihat katalog buku dan meminjam/mengembalikan buku.</p>

                <!-- Fitur Terbatas Siswa -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="p-4 bg-indigo-50 border border-indigo-200 rounded-lg">
                        <h4 class="font-bold text-indigo-800">Cek Katalog Buku</h4>
                        <p class="text-sm text-gray-600 mt-1">Cari buku yang ingin kamu pinjam.</p>
                    </div>
                    <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                        <h4 class="font-bold text-green-800">Riwayat Peminjaman</h4>
                        <p class="text-sm text-gray-600 mt-1">Lihat daftar buku yang sedang kamu pinjam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>