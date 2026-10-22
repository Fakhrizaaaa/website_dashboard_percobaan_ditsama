<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Pengumuman</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.pengumuman.create') }}"
                       class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                        + Buat Pengumuman
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="border-b font-semibold text-gray-700">
                            <tr>
                                <th class="py-2 pr-4">Tanggal</th>
                                <th class="py-2 pr-4">Judul</th>
                                <th class="py-2 pr-4">Penulis</th>
                                <th class="py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftar as $p)
                                <tr class="border-b">
                                    <td class="py-2 pr-4 whitespace-nowrap">{{ $p->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="py-2 pr-4">{{ $p->judul }}</td>
                                    <td class="py-2 pr-4">{{ $p->penulis?->name ?? '-' }}</td>
                                    <td class="py-2 flex gap-3">
                                        <a href="{{ route('admin.pengumuman.edit', $p) }}"
                                           class="text-blue-600 hover:underline">Edit</a>
                                        <form method="POST" action="{{ route('admin.pengumuman.destroy', $p) }}"
                                              onsubmit="return confirm('Hapus pengumuman ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-500">Belum ada pengumuman.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $daftar->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>