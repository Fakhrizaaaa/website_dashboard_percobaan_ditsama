<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Dashboard Admin</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <!-- Sambutan -->
            <div class="rounded-2xl bg-indigo-600 px-6 py-8 text-white shadow-sm sm:px-8">
                <p class="text-sm text-indigo-100">Selamat datang kembali</p>
                <h3 class="mt-1 text-2xl font-bold">{{ Auth::user()->name }}</h3>
                <p class="mt-2 text-sm text-indigo-100">Kelola seluruh data sistem akademik perkuliahan di sini.</p>
            </div>

            <!-- Ringkasan -->
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                <x-stat-card label="Total User" :value="$jumlahUser" />
                <x-stat-card label="Mata Kuliah" :value="$jumlahMatkul" />
                <x-stat-card label="Jadwal Kuliah" :value="$jumlahJadwal" />
                <x-stat-card label="Jadwal Ujian" :value="$jumlahUjian" />
            </div>

            <!-- Menu -->
            <div>
                <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-gray-500">Menu Pengelolaan</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <x-menu-card :href="route('admin.users.index')" icon="user" color="blue"
                        title="Kelola User" desc="Kelola data admin, dosen, mahasiswa, dan KRS." />
                    <x-menu-card :href="route('admin.mata-kuliah.index')" icon="book" color="emerald"
                        title="Kelola Mata Kuliah" desc="Tambah dan atur mata kuliah beserta dosen pengampu." />
                    <x-menu-card :href="route('admin.perkuliahan.index')" icon="calendar" color="violet"
                        title="Kelola Perkuliahan" desc="Atur jadwal kelas, jam, dan ruangan." />
                    <x-menu-card :href="route('admin.ujian.index')" icon="document" color="amber"
                        title="Kelola Ujian" desc="Atur jadwal UTS dan UAS." />
                    <x-menu-card :href="route('admin.pengumuman.index')" icon="bell" color="rose"
                        title="Kelola Pengumuman" desc="Buat pengumuman yang tampil di portal mahasiswa." />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>