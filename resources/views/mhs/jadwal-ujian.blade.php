<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Jadwal Ujian</h2>
        <p class="text-sm text-gray-500">Jadwal UTS dan UAS dari mata kuliah yang kamu ambil.</p>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-card class="overflow-hidden">
                @if ($daftar->isEmpty())
                    <div class="p-8 text-center text-gray-600">
                        Belum ada jadwal ujian. Pastikan kamu sudah terdaftar di mata kuliah (hubungi admin untuk mengisi KRS),
                        dan jadwal ujiannya sudah dibuat oleh admin.
                    </div>
                @else
                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Mata Kuliah</th>
                                <th>Jenis</th>
                                <th>Ruangan</th>
                                <th>Status</th>
                            </tr>
                        </x-slot>

                        @foreach ($daftar as $u)
                            @php $lewat = $u->tanggal->lt(today()); @endphp
                            <tr class="hover:bg-gray-50 {{ $lewat ? 'text-gray-400' : '' }}">
                                <td class="whitespace-nowrap font-medium">{{ $u->tanggal->format('d-m-Y') }}</td>
                                <td class="whitespace-nowrap">{{ substr($u->jam_mulai, 0, 5) }} - {{ substr($u->jam_selesai, 0, 5) }}</td>
                                <td>{{ $u->mataKuliah->kode }} - {{ $u->mataKuliah->nama }}</td>
                                <td><x-badge :color="$u->jenis === 'UTS' ? 'sky' : 'rose'">{{ $u->jenis }}</x-badge></td>
                                <td>{{ $u->ruangan }}</td>
                                <td>
                                    @if ($lewat)
                                        <x-badge>Sudah lewat</x-badge>
                                    @elseif ($u->tanggal->isToday())
                                        <x-badge color="amber">Hari ini</x-badge>
                                    @else
                                        <x-badge color="emerald">Akan datang</x-badge>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>