<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Kelola Perkuliahan</h2>
                <p class="text-sm text-gray-500">
                    {{ $prefix === 'admin' ? 'Jadwal kuliah semua mata kuliah.' : 'Jadwal kuliah mata kuliah yang kamu ampu.' }}
                </p>
            </div>
            <x-link-button :href="route($prefix.'.perkuliahan.create')">
                <x-icon name="plus" class="h-4 w-4" /> Tambah Jadwal Kuliah
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
                            @if ($prefix === 'admin')
                                <th>Dosen</th>
                            @endif
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Ruangan</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>

                    @forelse ($daftar as $p)
                        <tr class="hover:bg-gray-50">
                            <td>
                                <p class="font-medium text-gray-900">{{ $p->mataKuliah->nama }}</p>
                                <p class="text-xs text-gray-500">{{ $p->mataKuliah->kode }}</p>
                            </td>
                            @if ($prefix === 'admin')
                                <td>{{ $p->mataKuliah->dosen?->name ?? '-' }}</td>
                            @endif
                            <td><x-badge color="violet">{{ $p->hari }}</x-badge></td>
                            <td class="whitespace-nowrap">{{ substr($p->jam_mulai, 0, 5) }} - {{ substr($p->jam_selesai, 0, 5) }}</td>
                            <td>{{ $p->ruangan }}</td>
                            <td>{{ $p->semester ?? '-' }}</td>
                            <td>
                                <div class="flex items-center gap-4">
                                    <a href="{{ route($prefix.'.perkuliahan.edit', $p) }}"
                                       class="font-medium text-indigo-600 hover:text-indigo-800">Edit</a>
                                    <form method="POST" action="{{ route($prefix.'.perkuliahan.destroy', $p) }}"
                                          onsubmit="return confirm('Hapus jadwal kuliah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-gray-500">Belum ada jadwal perkuliahan.</td>
                        </tr>
                    @endforelse
                </x-table>
            </x-card>
        </div>
    </div>
</x-app-layout>