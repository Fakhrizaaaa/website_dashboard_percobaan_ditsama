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

                <!-- Ringkasan -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="text-xs text-gray-500">Mata Kuliah Diambil</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $jumlahMatkul }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="text-xs text-gray-500">Total SKS</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalSks }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="text-xs text-gray-500">Ujian Terdekat</p>
                        @if ($ujianTerdekat)
                            <p class="text-sm font-semibold text-gray-800">
                                {{ $ujianTerdekat->jenis }} {{ $ujianTerdekat->mataKuliah->nama }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $ujianTerdekat->tanggal->format('d-m-Y') }}, {{ substr($ujianTerdekat->jam_mulai, 0, 5) }}</p>
                        @else
                            <p class="text-sm font-semibold text-gray-800">Belum ada</p>
                        @endif
                    </div>
                </div>

                @if ($jumlahMatkul === 0)
                    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg text-sm">
                        Kamu belum terdaftar di mata kuliah mana pun. Hubungi admin untuk mengisi KRS.
                    </div>
                @endif

                <!-- Grid Menu Mahasiswa -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- 1. Landing Page / Informasi Kampus -->
                    <a href="{{ route('mhs.informasi') }}" class="block p-5 bg-rose-50 border border-rose-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-rose-800 text-lg mb-1">1. Informasi Kampus</h4>
                        <p class="text-sm text-gray-600 mb-3">Pengumuman & berita terbaru seputar perkuliahan.</p>
                        <span class="inline-block px-3 py-1 bg-rose-600 text-white text-xs font-semibold rounded">Informasi</span>
                    </a>

                    <!-- 2. Jadwal Perkuliahan -->
                    <a href="{{ route('mhs.jadwal-kuliah') }}" class="block p-5 bg-sky-50 border border-sky-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-sky-800 text-lg mb-1">2. Jadwal Perkuliahan</h4>
                        <p class="text-sm text-gray-600 mb-3">Cek jadwal kelas mingguan dan ruangan perkuliahan.</p>
                        <span class="inline-block px-3 py-1 bg-sky-600 text-white text-xs font-semibold rounded">Lihat Jadwal</span>
                    </a>

                    <!-- 3. Jadwal Ujian -->
                    <a href="{{ route('mhs.jadwal-ujian') }}" class="block p-5 bg-orange-50 border border-orange-200 rounded-lg hover:shadow-md transition">
                        <h4 class="font-bold text-orange-800 text-lg mb-1">3. Jadwal Ujian</h4>
                        <p class="text-sm text-gray-600 mb-3">Cek jadwal UTS & UAS semester ini.</p>
                        <span class="inline-block px-3 py-1 bg-orange-600 text-white text-xs font-semibold rounded">Lihat Ujian</span>
                    </a>
                </div>

                <!-- Pengumuman Terbaru -->
                <div class="mt-6">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="font-bold text-gray-800">Pengumuman Terbaru</h4>
                        <a href="{{ route('mhs.informasi') }}" class="text-sm text-rose-600 hover:underline">Lihat semua</a>
                    </div>
                    @forelse ($pengumumanTerbaru as $p)
                        <div class="mb-3 p-4 border border-gray-200 rounded-lg">
                            <p class="font-semibold text-gray-800">{{ $p->judul }}</p>
                            <p class="text-xs text-gray-500 mb-1">{{ $p->created_at->format('d-m-Y H:i') }}</p>
                            <p class="text-sm text-gray-700 whitespace-pre-line">{{ \Illuminate\Support\Str::limit($p->isi, 200) }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada pengumuman.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>