<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Dashboard Dosen</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <!-- Sambutan -->
            <div class="rounded-2xl bg-indigo-600 px-6 py-8 text-white shadow-sm sm:px-8">
                <p class="text-sm text-indigo-100">Selamat datang</p>
                <h3 class="mt-1 text-2xl font-bold">{{ Auth::user()->name }}</h3>
                <p class="mt-2 text-sm text-indigo-100">Area khusus pengajaran dan pengampuan mata kuliah.</p>
            </div>

            <!-- Ringkasan -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <x-stat-card label="Mata Kuliah Diampu" :value="$jumlahMatkul" />
                <x-stat-card label="Jadwal Kuliah" :value="$jumlahJadwal" />
                <x-stat-card label="Mahasiswa" :value="$jumlahMahasiswa" hint="Total mahasiswa di semua mata kuliahmu" />
            </div>

            <!-- Menu -->
            <div>
                <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-gray-500">Menu</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <x-menu-card :href="route('dosen.mata-kuliah.index')" icon="book" color="indigo"
                        title="Kelola Mata Kuliah" desc="Tambah dan atur mata kuliah yang kamu ampu." />
                    <x-menu-card :href="route('dosen.perkuliahan.index')" icon="calendar" color="teal"
                        title="Kelola Perkuliahan" desc="Atur jadwal kuliah (hari, jam, ruangan) untuk mata kuliahmu." />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>