@php
    $role = Auth::user()->role;

    // Menu per role: judul bagian => daftar [label, nama route, pola route aktif, ikon]
    $sections = match ($role) {
        'admin' => [
            'Akademik' => [
                ['Mata Kuliah', 'admin.mata-kuliah.index', 'admin.mata-kuliah.*', 'book'],
                ['Perkuliahan', 'admin.perkuliahan.index', 'admin.perkuliahan.*', 'calendar'],
                ['Ujian', 'admin.ujian.index', 'admin.ujian.*', 'document'],
            ],
            'Pengguna & Informasi' => [
                ['Kelola User', 'admin.users.index', 'admin.users.*', 'user'],
                ['Pengumuman', 'admin.pengumuman.index', 'admin.pengumuman.*', 'bell'],
            ],
        ],
        'dosen' => [
            'Akademik' => [
                ['Mata Kuliah', 'dosen.mata-kuliah.index', 'dosen.mata-kuliah.*', 'book'],
                ['Perkuliahan', 'dosen.perkuliahan.index', 'dosen.perkuliahan.*', 'calendar'],
            ],
        ],
        default => [
            'Akademik' => [
                ['Jadwal Kuliah', 'mhs.jadwal-kuliah', 'mhs.jadwal-kuliah', 'calendar'],
                ['Jadwal Ujian', 'mhs.jadwal-ujian', 'mhs.jadwal-ujian', 'document'],
            ],
            'Informasi' => [
                ['Informasi Kampus', 'mhs.informasi', 'mhs.informasi', 'bell'],
            ],
        ],
    };

    $roleLabel = ['admin' => 'Admin', 'dosen' => 'Dosen', 'mhs' => 'Mahasiswa'][$role] ?? ucfirst($role);
@endphp

<!-- Top bar khusus layar kecil (tombol buka sidebar) -->
<div class="sticky top-0 z-30 flex h-14 items-center gap-3 border-b border-gray-200 bg-white px-4 lg:hidden">
    <button type="button" @click="sidebarOpen = true"
            class="rounded-md p-2 text-gray-500 hover:bg-gray-100 focus:outline-none" aria-label="Buka menu">
        <x-icon name="bars" class="h-6 w-6" />
    </button>
    <span class="font-semibold text-gray-900">Portal Akademik</span>
</div>

<!-- Overlay (layar kecil) -->
<div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
     class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden" style="display: none;"></div>

<!-- Sidebar -->
<aside :class="{ '!translate-x-0': sidebarOpen }"
       class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col bg-slate-900 transition-transform duration-200 lg:translate-x-0">
    <!-- Logo -->
    <div class="flex h-16 shrink-0 items-center justify-between border-b border-slate-800 px-4">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white">
                <x-icon name="book" class="h-5 w-5" />
            </span>
            <span class="leading-tight">
                <span class="block text-sm font-semibold text-white">Portal Akademik</span>
                <span class="block text-xs text-slate-400">{{ $roleLabel }}</span>
            </span>
        </a>

        <button type="button" @click="sidebarOpen = false"
                class="rounded-md p-1.5 text-slate-400 hover:bg-slate-800 hover:text-white lg:hidden" aria-label="Tutup menu">
            <x-icon name="x-mark" class="h-5 w-5" />
        </button>
    </div>

    <!-- Menu -->
    <nav class="flex-1 space-y-6 overflow-y-auto px-3 py-4">
        <div class="space-y-1">
            <p class="px-3 pb-1 text-xs font-semibold uppercase tracking-wider text-slate-500">Menu Utama</p>
            <x-sidebar-link :href="route('dashboard')" icon="home"
                :active="request()->routeIs('dashboard', 'admin.dashboard', 'dosen.dashboard', 'mhs.dashboard')">
                Dashboard
            </x-sidebar-link>
        </div>

        @foreach ($sections as $title => $items)
            <div class="space-y-1">
                <p class="px-3 pb-1 text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $title }}</p>
                @foreach ($items as [$label, $routeName, $pattern, $icon])
                    <x-sidebar-link :href="route($routeName)" :icon="$icon" :active="request()->routeIs($pattern)">
                        {{ $label }}
                    </x-sidebar-link>
                @endforeach
            </div>
        @endforeach
    </nav>

    <!-- Akun -->
    <div class="shrink-0 border-t border-slate-800 p-3">
        <div class="flex items-center gap-3 px-2 py-2">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-500 text-sm font-semibold text-white">
                {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
            </span>
            <div class="min-w-0">
                <p class="truncate text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                <p class="truncate text-xs text-slate-400">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="mt-1 space-y-1">
            <x-sidebar-link :href="route('profile.edit')" icon="user-circle" :active="request()->routeIs('profile.*')">
                Profil Saya
            </x-sidebar-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="group flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                    <x-icon name="logout" class="h-5 w-5 shrink-0 text-slate-400 group-hover:text-white" />
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>
</aside>