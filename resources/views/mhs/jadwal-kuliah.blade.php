<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Perkuliahan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if ($jadwal->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-600">
                    Belum ada jadwal kuliah. Pastikan kamu sudah terdaftar di mata kuliah (hubungi admin untuk mengisi KRS),
                    dan jadwalnya sudah dibuat oleh dosen atau admin.
                </div>
            @else
                @foreach ($hariList as $hari)
                    @if ($jadwal->has($hari))
                        <div class="bg-white shadow-sm sm:rounded-lg p-6 {{ $hari === $hariIni ? 'ring-2 ring-sky-400' : '' }}">
                            <h3 class="font-bold text-sky-800 mb-3">
                                {{ $hari }}
                                @if ($hari === $hariIni)
                                    <span class="ml-2 text-xs bg-sky-600 text-white px-2 py-0.5 rounded">Hari ini</span>
                                @endif
                            </h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm text-left">
                                    <thead class="border-b font-semibold text-gray-700">
                                        <tr>
                                            <th class="py-2 pr-4">Jam</th>
                                            <th class="py-2 pr-4">Mata Kuliah</th>
                                            <th class="py-2 pr-4">Dosen</th>
                                            <th class="py-2">Ruangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwal[$hari] as $p)
                                            <tr class="border-b last:border-0">
                                                <td class="py-2 pr-4 whitespace-nowrap">{{ substr($p->jam_mulai, 0, 5) }} - {{ substr($p->jam_selesai, 0, 5) }}</td>
                                                <td class="py-2 pr-4">{{ $p->mataKuliah->kode }} - {{ $p->mataKuliah->nama }}</td>
                                                <td class="py-2 pr-4">{{ $p->mataKuliah->dosen?->name ?? '-' }}</td>
                                                <td class="py-2">{{ $p->ruangan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>