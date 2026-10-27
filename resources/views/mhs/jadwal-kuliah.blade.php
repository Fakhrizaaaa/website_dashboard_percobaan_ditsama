<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Jadwal Perkuliahan</h2>
        <p class="text-sm text-gray-500">Jadwal kelas mingguan dari mata kuliah yang kamu ambil.</p>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl space-y-4 px-4 sm:px-6 lg:px-8">
            @if ($jadwal->isEmpty())
                <x-card class="p-8 text-center text-gray-600">
                    Belum ada jadwal kuliah. Pastikan kamu sudah terdaftar di mata kuliah (hubungi admin untuk mengisi KRS),
                    dan jadwalnya sudah dibuat oleh dosen atau admin.
                </x-card>
            @else
                @foreach ($hariList as $hari)
                    @if ($jadwal->has($hari))
                        <x-card class="overflow-hidden {{ $hari === $hariIni ? 'ring-2 ring-indigo-400' : '' }}">
                            <div class="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-6 py-3">
                                <h3 class="font-semibold text-gray-900">{{ $hari }}</h3>
                                @if ($hari === $hariIni)
                                    <x-badge color="indigo">Hari ini</x-badge>
                                @endif
                            </div>

                            <ul class="divide-y divide-gray-100">
                                @foreach ($jadwal[$hari] as $p)
                                    <li class="flex flex-col gap-2 px-6 py-4 sm:flex-row sm:items-center sm:gap-6">
                                        <div class="flex w-36 shrink-0 items-center gap-2 text-sm font-semibold text-indigo-600">
                                            <x-icon name="clock" class="h-4 w-4" />
                                            {{ substr($p->jam_mulai, 0, 5) }} - {{ substr($p->jam_selesai, 0, 5) }}
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900">{{ $p->mataKuliah->nama }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $p->mataKuliah->kode }} &middot; {{ $p->mataKuliah->dosen?->name ?? 'Dosen belum ditentukan' }}
                                            </p>
                                        </div>
                                        <x-badge>{{ $p->ruangan }}</x-badge>
                                    </li>
                                @endforeach
                            </ul>
                        </x-card>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>