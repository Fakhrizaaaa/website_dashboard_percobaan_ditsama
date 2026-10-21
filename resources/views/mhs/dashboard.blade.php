<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portal Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-rose-600 mb-2">Halo, {{ Auth::user()->name }} (Mahasiswa)!</h3>
                <p class="text-gray-600 mb-6">Selamat datang di portal akademik perkuliahan kamu.</p>

                <!-- Grid Menu Mahasiswa -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- 1. Landing Page / Informasi Kampus -->
                    <div class="p-5 bg-rose-50 border border-rose-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-rose-800 text-lg mb-1">1. Informasi Kampus</h4>
                        <p class="text-sm text-gray-600 mb-3">Pengumuman & berita terbaru seputar perkuliahan.</p>
                        <span class="inline-block px-3 py-1 bg-rose-600 text-white text-xs font-semibold rounded">Informasi</span>
                    </div>

                    <!-- 2. Jadwal Perkuliahan -->
                    <div class="p-5 bg-sky-50 border border-sky-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-sky-800 text-lg mb-1">2. Jadwal Perkuliahan</h4>
                        <p class="text-sm text-gray-600 mb-3">Cek jadwal kelas mingguan dan ruangan perkuliahan.</p>
                        <span class="inline-block px-3 py-1 bg-sky-600 text-white text-xs font-semibold rounded">Lihat Jadwal</span>
                    </div>

                    <!-- 3. Jadwal Ujian -->
                    <div class="p-5 bg-orange-50 border border-orange-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-orange-800 text-lg mb-1">3. Jadwal Ujian</h4>
                        <p class="text-sm text-gray-600 mb-3">Cek jadwal UTS & UAS semester ini.</p>
                        <span class="inline-block px-3 py-1 bg-orange-600 text-white text-xs font-semibold rounded">Lihat Ujian</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>