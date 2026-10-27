<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Kelola Ujian</h2>
                <p class="text-sm text-gray-500">Jadwal UTS dan UAS semua mata kuliah.</p>
            </div>
            <x-link-button :href="route('admin.ujian.create')">
                <x-icon name="plus" class="h-4 w-4" /> Tambah Jadwal Ujian
            </x-link-button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-card class="overflow-hidden">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Ruangan</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>

                    @forelse ($daftar as $u)
                        <tr class="hover:bg-gray-50">
                            <td>
                                <p class="font-medium text-gray-900">{{ $u->mataKuliah->nama }}</p>
                                <p class="text-xs text-gray-500">{{ $u->mataKuliah->kode }}</p>
                            </td>
                            <td><x-badge :color="$u->jenis === 'UTS' ? 'sky' : 'rose'">{{ $u->jenis }}</x-badge></td>
                            <td class="whitespace-nowrap">{{ $u->tanggal->format('d-m-Y') }}</td>
                            <td class="whitespace-nowrap">{{ substr($u->jam_mulai, 0, 5) }} - {{ substr($u->jam_selesai, 0, 5) }}</td>
                            <td>{{ $u->ruangan }}</td>
                            <td>
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.ujian.edit', $u) }}"
                                       class="font-medium text-indigo-600 hover:text-indigo-800">Edit</a>
                                    <form method="POST" action="{{ route('admin.ujian.destroy', $u) }}"
                                          onsubmit="return confirm('Hapus jadwal ujian ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-500">Belum ada jadwal ujian.</td>
                        </tr>
                    @endforelse
                </x-table>
            </x-card>
        </div>
    </div>
</x-app-layout>