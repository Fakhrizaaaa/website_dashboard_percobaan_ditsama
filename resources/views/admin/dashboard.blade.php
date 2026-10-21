<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin Perpustakaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-green-600 mb-2">Selamat Datang, Admin {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 mb-4">Di sini Anda memiliki akses penuh untuk mengelola seluruh data perpustakaan.</p>
                
                <!-- Fitur Khusus Admin -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <h4 class="font-bold text-blue-800">Kelola Buku</h4>
                        <p class="text-sm text-gray-600 mt-1">Tambah, Edit, dan Hapus data buku.</p>
                    </div>
                    <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <h4 class="font-bold text-yellow-800">Kelola Peminjaman</h4>
                        <p class="text-sm text-gray-600 mt-1">Setujui atau verifikasi pengembalian buku.</p>
                    </div>
                    <div class="p-4 bg-purple-50 border border-purple-200 rounded-lg">
                        <h4 class="font-bold text-purple-800">Data Siswa</h4>
                        <p class="text-sm text-gray-600 mt-1">Lihat daftar anggota siswa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>