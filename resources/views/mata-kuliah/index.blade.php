<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Mata Kuliah</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route($prefix.'.mata-kuliah.create') }}"
                       class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                        + Tambah Mata Kuliah
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="border-b font-semibold text-gray-700">
                            <tr>
                                <th class="py-2 pr-4">Kode</th>
                                <th class="py-2 pr-4">Nama</th>
                                <th class="py-2 pr-4">SKS</th>
                                @if ($prefix === 'admin')
                                    <th class="py-2 pr-4">Dosen Pengampu</th>
                                @endif
                                <th class="py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftar as $mk)
                                <tr class="border-b">
                                    <td class="py-2 pr-4">{{ $mk->kode }}</td>
                                    <td class="py-2 pr-4">{{ $mk->nama }}</td>
                                    <td class="py-2 pr-4">{{ $mk->sks }}</td>
                                    @if ($prefix === 'admin')
                                        <td class="py-2 pr-4">{{ $mk->dosen?->name ?? '-' }}</td>
                                    @endif
                                    <td class="py-2 flex gap-3">
                                        <a href="{{ route($prefix.'.mata-kuliah.edit', $mk) }}"
                                           class="text-blue-600 hover:underline">Edit</a>
                                        <form method="POST" action="{{ route($prefix.'.mata-kuliah.destroy', $mk) }}"
                                              onsubmit="return confirm('Hapus mata kuliah ini? Jadwal kuliah, jadwal ujian, dan data KRS terkait ikut terhapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">Belum ada mata kuliah.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>