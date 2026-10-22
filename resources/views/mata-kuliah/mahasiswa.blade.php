<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mahasiswa: {{ $mataKuliah->kode }} - {{ $mataKuliah->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-sm text-gray-600">
                        Total: <span class="font-semibold">{{ $mahasiswa->count() }}</span> mahasiswa
                    </p>
                    <a href="{{ route($prefix.'.mata-kuliah.index') }}" class="text-sm text-gray-600 hover:underline">
                        &larr; Kembali
                    </a>
                </div>

                @if ($mahasiswa->isEmpty())
                    <p class="text-gray-500">Belum ada mahasiswa yang mengambil mata kuliah ini.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead class="border-b font-semibold text-gray-700">
                                <tr>
                                    <th class="py-2 pr-4">No</th>
                                    <th class="py-2 pr-4">Nama</th>
                                    <th class="py-2">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $m)
                                    <tr class="border-b last:border-0">
                                        <td class="py-2 pr-4">{{ $loop->iteration }}</td>
                                        <td class="py-2 pr-4">{{ $m->name }}</td>
                                        <td class="py-2">{{ $m->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if ($prefix === 'admin')
                    <p class="mt-4 text-xs text-gray-500">
                        Untuk mengubah daftar ini, edit KRS mahasiswa lewat menu Kelola User.
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>