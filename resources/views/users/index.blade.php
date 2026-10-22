<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola User</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-wrap justify-between items-center gap-3 mb-4">
                    <div class="flex gap-2 text-sm">
                        <a href="{{ route('admin.users.index') }}"
                           class="px-3 py-1 rounded {{ $role ? 'bg-gray-100 text-gray-700' : 'bg-gray-800 text-white' }}">Semua</a>
                        @foreach ($roles as $r)
                            <a href="{{ route('admin.users.index', ['role' => $r]) }}"
                               class="px-3 py-1 rounded {{ $role === $r ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($r) }}
                            </a>
                        @endforeach
                    </div>

                    <a href="{{ route('admin.users.create') }}"
                       class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                        + Tambah User
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="border-b font-semibold text-gray-700">
                            <tr>
                                <th class="py-2 pr-4">Nama</th>
                                <th class="py-2 pr-4">Email</th>
                                <th class="py-2 pr-4">Role</th>
                                <th class="py-2 pr-4">Mata Kuliah Diambil</th>
                                <th class="py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $u)
                                <tr class="border-b">
                                    <td class="py-2 pr-4">{{ $u->name }}</td>
                                    <td class="py-2 pr-4">{{ $u->email }}</td>
                                    <td class="py-2 pr-4">
                                        <span class="px-2 py-1 rounded text-xs font-semibold
                                            {{ $u->role === 'admin' ? 'bg-blue-100 text-blue-800' : ($u->role === 'dosen' ? 'bg-indigo-100 text-indigo-800' : 'bg-emerald-100 text-emerald-800') }}">
                                            {{ strtoupper($u->role) }}
                                        </span>
                                    </td>
                                    <td class="py-2 pr-4">
                                        {{ $u->role === 'mhs' ? $u->mata_kuliah_diambil_count.' mata kuliah' : '-' }}
                                    </td>
                                    <td class="py-2 flex gap-3">
                                        <a href="{{ route('admin.users.edit', $u) }}"
                                           class="text-blue-600 hover:underline">Edit</a>
                                        @if ($u->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                                                  onsubmit="return confirm('Hapus user ini? Data KRS miliknya ikut terhapus.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">Belum ada user.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>