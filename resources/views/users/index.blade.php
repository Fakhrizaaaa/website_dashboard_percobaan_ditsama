<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Kelola User</h2>
                <p class="text-sm text-gray-500">Akun admin, dosen, dan mahasiswa beserta KRS-nya.</p>
            </div>
            <x-link-button :href="route('admin.users.create')">
                <x-icon name="plus" class="h-4 w-4" /> Tambah User
            </x-link-button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-card class="overflow-hidden">
                <!-- Filter role -->
                <div class="flex flex-wrap gap-2 border-b border-gray-200 px-6 py-4 text-sm">
                    <a href="{{ route('admin.users.index') }}"
                       class="rounded-full px-3.5 py-1.5 font-medium transition {{ $role ? 'bg-gray-100 text-gray-600 hover:bg-gray-200' : 'bg-indigo-600 text-white' }}">Semua</a>
                    @foreach ($roles as $r)
                        <a href="{{ route('admin.users.index', ['role' => $r]) }}"
                           class="rounded-full px-3.5 py-1.5 font-medium transition {{ $role === $r ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            {{ ucfirst($r) }}
                        </a>
                    @endforeach
                </div>

                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Mata Kuliah Diambil</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>

                    @forelse ($users as $u)
                        <tr class="hover:bg-gray-50">
                            <td class="font-medium text-gray-900">{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <x-badge :color="$u->role === 'admin' ? 'blue' : ($u->role === 'dosen' ? 'violet' : 'emerald')">
                                    {{ strtoupper($u->role) }}
                                </x-badge>
                            </td>
                            <td>{{ $u->role === 'mhs' ? $u->mata_kuliah_diambil_count.' mata kuliah' : '-' }}</td>
                            <td>
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.users.edit', $u) }}"
                                       class="font-medium text-indigo-600 hover:text-indigo-800">Edit</a>
                                    @if ($u->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                                              onsubmit="return confirm('Hapus user ini? Data KRS miliknya ikut terhapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-gray-500">Belum ada user.</td>
                        </tr>
                    @endforelse
                </x-table>

                @if ($users->hasPages())
                    <div class="border-t border-gray-200 px-6 py-4">{{ $users->links() }}</div>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>