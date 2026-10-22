<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Ujian</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if ($daftar->isEmpty())
                    <p class="text-gray-600">
                        Belum ada jadwal ujian. Pastikan kamu sudah terdaftar di mata kuliah (hubungi admin untuk mengisi KRS),
                        dan jadwal ujiannya sudah dibuat oleh admin.
                    </p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead class="border-b font-semibold text-gray-700">
                                <tr>
                                    <th class="py-2 pr-4">Tanggal</th>
                                    <th class="py-2 pr-4">Jam</th>
                                    <th class="py-2 pr-4">Mata Kuliah</th>
                                    <th class="py-2 pr-4">Jenis</th>
                                    <th class="py-2 pr-4">Ruangan</th>
                                    <th class="py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftar as $u)
                                    @php $lewat = $u->tanggal->lt(today()); @endphp
                                    <tr class="border-b last:border-0 {{ $lewat ? 'text-gray-400' : '' }}">
                                        <td class="py-2 pr-4 whitespace-nowrap">{{ $u->tanggal->format('d-m-Y') }}</td>
                                        <td class="py-2 pr-4 whitespace-nowrap">{{ substr($u->jam_mulai, 0, 5) }} - {{ substr($u->jam_selesai, 0, 5) }}</td>
                                        <td class="py-2 pr-4">{{ $u->mataKuliah->kode }} - {{ $u->mataKuliah->nama }}</td>
                                        <td class="py-2 pr-4">{{ $u->jenis }}</td>
                                        <td class="py-2 pr-4">{{ $u->ruangan }}</td>
                                        <td class="py-2">
                                            @if ($lewat)
                                                <span class="text-xs">Sudah lewat</span>
                                            @elseif ($u->tanggal->isToday())
                                                <span class="text-xs bg-orange-600 text-white px-2 py-0.5 rounded">Hari ini</span>
                                            @else
                                                <span class="text-xs bg-orange-100 text-orange-800 px-2 py-0.5 rounded">Akan datang</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>