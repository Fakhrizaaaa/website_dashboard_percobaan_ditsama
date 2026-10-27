<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Kelola Mata Kuliah</h2>
                <p class="text-sm text-gray-500">
                    {{ $prefix === 'admin' ? 'Seluruh mata kuliah di sistem.' : 'Mata kuliah yang kamu ampu.' }}
                </p>
            </div>
            <x-link-button :href="route($prefix.'.mata-kuliah.create')">
                <x-icon name="plus" class="h-4 w-4" /> Tambah Mata Kuliah
            </x-link-button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-card class="overflow-hidden">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>SKS</th>
                            <th>Mahasiswa</th>
                            @if ($prefix === 'admin')
                                <th>Dosen Pengampu</th>
                            @endif
                            <th>Aksi</th>
                        </tr>
                    </x-slot>

                    @forelse ($daftar as $mk)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap font-medium text-gray-900">{{ $mk->kode }}</td>
                            <td>{{ $mk->nama }}</td>
                            <td>{{ $mk->sks }}</td>
                            <td>
                                <a href="{{ route($prefix.'.mata-kuliah.mahasiswa', $mk) }}"
                                   class="font-medium text-indigo-600 hover:text-indigo-800">{{ $mk->mahasiswa_count }} mahasiswa</a>
                            </td>
                            @if ($prefix === 'admin')
                                <td>{{ $mk->dosen?->name ?? '-' }}</td>
                            @endif
                            <td>
                                <div class="flex items-center gap-4">
                                    <a href="{{ route($prefix.'.mata-kuliah.edit', $mk) }}"
                                       class="font-medium text-indigo-600 hover:text-indigo-800">Edit</a>
                                    <form method="POST" action="{{ route($prefix.'.mata-kuliah.destroy', $mk) }}"
                                          onsubmit="return confirm('Hapus mata kuliah ini? Jadwal kuliah, jadwal ujian, dan data KRS terkait ikut terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-500">Belum ada mata kuliah.</td>
                        </tr>
                    @endforelse
                </x-table>
            </x-card>
        </div>
    </div>
</x-app-layout>