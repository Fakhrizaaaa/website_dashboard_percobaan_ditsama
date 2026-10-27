<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Mahasiswa Mata Kuliah</h2>
                <p class="text-sm text-gray-500">{{ $mataKuliah->kode }} - {{ $mataKuliah->nama }}</p>
            </div>
            <x-link-button variant="secondary" :href="route($prefix.'.mata-kuliah.index')">
                <x-icon name="arrow-left" class="h-4 w-4" /> Kembali
            </x-link-button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <x-card class="overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4 text-sm text-gray-600">
                    Total: <span class="font-semibold text-gray-900">{{ $mahasiswa->count() }}</span> mahasiswa
                </div>

                @if ($mahasiswa->isEmpty())
                    <p class="px-6 py-10 text-center text-gray-500">Belum ada mahasiswa yang mengambil mata kuliah ini.</p>
                @else
                    <x-table>
                        <x-slot name="head">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                            </tr>
                        </x-slot>

                        @foreach ($mahasiswa as $m)
                            <tr class="hover:bg-gray-50">
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-medium text-gray-900">{{ $m->name }}</td>
                                <td>{{ $m->email }}</td>
                            </tr>
                        @endforeach
                    </x-table>
                @endif

                @if ($prefix === 'admin')
                    <p class="border-t border-gray-100 px-6 py-3 text-xs text-gray-500">
                        Untuk mengubah daftar ini, edit KRS mahasiswa lewat menu Kelola User.
                    </p>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>