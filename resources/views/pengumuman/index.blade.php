<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Kelola Pengumuman</h2>
                <p class="text-sm text-gray-500">Pengumuman yang tampil di portal mahasiswa.</p>
            </div>
            <x-link-button :href="route('admin.pengumuman.create')">
                <x-icon name="plus" class="h-4 w-4" /> Buat Pengumuman
            </x-link-button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-card class="overflow-hidden">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>

                    @forelse ($daftar as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap">{{ $p->created_at->format('d-m-Y H:i') }}</td>
                            <td class="font-medium text-gray-900">{{ $p->judul }}</td>
                            <td>{{ $p->penulis?->name ?? '-' }}</td>
                            <td>
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.pengumuman.edit', $p) }}"
                                       class="font-medium text-indigo-600 hover:text-indigo-800">Edit</a>
                                    <form method="POST" action="{{ route('admin.pengumuman.destroy', $p) }}"
                                          onsubmit="return confirm('Hapus pengumuman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-500">Belum ada pengumuman.</td>
                        </tr>
                    @endforelse
                </x-table>

                @if ($daftar->hasPages())
                    <div class="border-t border-gray-200 px-6 py-4">{{ $daftar->links() }}</div>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>