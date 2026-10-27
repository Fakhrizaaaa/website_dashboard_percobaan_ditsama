<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Portal Mahasiswa</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <!-- Sambutan -->
            <div class="rounded-2xl bg-indigo-600 px-6 py-8 text-white shadow-sm sm:px-8">
                <p class="text-sm text-indigo-100">Halo,</p>
                <h3 class="mt-1 text-2xl font-bold">{{ Auth::user()->name }}</h3>
                <p class="mt-2 text-sm text-indigo-100">Selamat datang di portal akademik perkuliahan kamu.</p>
            </div>

            @if ($jumlahMatkul === 0)
                <div class="rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                    Kamu belum terdaftar di mata kuliah mana pun. Hubungi admin untuk mengisi KRS.
                </div>
            @endif

            <!-- Ringkasan -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <x-stat-card label="Mata Kuliah Diambil" :value="$jumlahMatkul" />
                <x-stat-card label="Total SKS" :value="$totalSks" />
                @if ($ujianTerdekat)
                    <x-stat-card label="Ujian Terdekat" small
                        :value="$ujianTerdekat->jenis.' '.$ujianTerdekat->mataKuliah->nama"
                        :hint="$ujianTerdekat->tanggal->format('d-m-Y').', '.substr($ujianTerdekat->jam_mulai, 0, 5)" />
                @else
                    <x-stat-card label="Ujian Terdekat" small value="Belum ada" />
                @endif
            </div>

            <!-- Menu -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <x-menu-card :href="route('mhs.informasi')" icon="bell" color="rose"
                    title="Informasi Kampus" desc="Pengumuman dan berita terbaru seputar perkuliahan." />
                <x-menu-card :href="route('mhs.jadwal-kuliah')" icon="calendar" color="sky"
                    title="Jadwal Perkuliahan" desc="Cek jadwal kelas mingguan dan ruangan." />
                <x-menu-card :href="route('mhs.jadwal-ujian')" icon="document" color="orange"
                    title="Jadwal Ujian" desc="Cek jadwal UTS dan UAS semester ini." />
            </div>

            <!-- Pengumuman terbaru -->
            <x-card class="p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-900">Pengumuman Terbaru</h3>
                    <a href="{{ route('mhs.informasi') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat semua</a>
                </div>

                <div class="space-y-3">
                    @forelse ($pengumumanTerbaru as $p)
                        <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                            <p class="font-medium text-gray-900">{{ $p->judul }}</p>
                            <p class="mb-1 text-xs text-gray-500">{{ $p->created_at->format('d-m-Y H:i') }}</p>
                            <p class="whitespace-pre-line text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($p->isi, 200) }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada pengumuman.</p>
                    @endforelse
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>