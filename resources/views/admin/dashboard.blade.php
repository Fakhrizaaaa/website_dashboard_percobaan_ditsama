<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin Akademik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-blue-600 mb-2">Selamat Datang, Admin ({{ Auth::user()->name }})!</h3>
                <p class="text-gray-600 mb-6">Kelola seluruh data sistem akademik perkuliahan di sini.</p>

                <!-- Grid Menu Admin -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- 1. Kelola User -->
                    <a href="{{ route('admin.users.index') }}" class="block p-5 bg-blue-50 border border-blue-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-blue-800 text-lg mb-1">1. Kelola User</h4>
                        <p class="text-sm text-gray-600 mb-3">Kelola data Admin, Dosen, dan Mahasiswa.</p>
                        <span class="inline-block px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded">Akses Penuh</span>
                    </a>

                    <!-- 2. Kelola Mata Kuliah (sudah jadi link) -->
                    <a href="{{ route('admin.mata-kuliah.index') }}" class="block p-5 bg-emerald-50 border border-emerald-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-emerald-800 text-lg mb-1">2. Kelola Matkul</h4>
                        <p class="text-sm text-gray-600 mb-3">Tambah & atur kurikulum mata kuliah.</p>
                        <span class="inline-block px-3 py-1 bg-emerald-600 text-white text-xs font-semibold rounded">Akses Penuh</span>
                    </a>

                    <!-- 3. Kelola Perkuliahan -->
                    <a href="{{ route('admin.perkuliahan.index') }}" class="block p-5 bg-purple-50 border border-purple-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-purple-800 text-lg mb-1">3. Kelola Kuliah</h4>
                        <p class="text-sm text-gray-600 mb-3">Atur jadwal kelas & pembagian dosen.</p>
                        <span class="inline-block px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded">Akses Penuh</span>
                    </a>

                    <!-- 4. Kelola Ujian -->
                    <a href="{{ route('admin.ujian.index') }}" class="block p-5 bg-amber-50 border border-amber-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-amber-800 text-lg mb-1">4. Kelola Ujian</h4>
                        <p class="text-sm text-gray-600 mb-3">Jadwal UTS/UAS & pengawasan ujian.</p>
                        <span class="inline-block px-3 py-1 bg-amber-600 text-white text-xs font-semibold rounded">Akses Penuh</span>
                    </a>
                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.pengumuman.index') }}" class="text-sm text-blue-600 hover:underline">
                        Kelola Pengumuman (tampil di portal mahasiswa) &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>