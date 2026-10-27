<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Informasi Kampus</h2>
        <p class="text-sm text-gray-500">Pengumuman dan berita terbaru seputar perkuliahan.</p>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl space-y-4 px-4 sm:px-6 lg:px-8">
            @forelse ($daftar as $p)
                <x-card class="p-6">
                    <div class="flex items-start gap-4">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                            <x-icon name="bell" class="h-5 w-5" />
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $p->judul }}</h3>
                            <p class="mb-3 text-xs text-gray-500">
                                {{ $p->created_at->format('d-m-Y H:i') }}
                                @if ($p->penulis) &middot; {{ $p->penulis->name }} @endif
                            </p>
                            <p class="whitespace-pre-line text-sm leading-relaxed text-gray-700">{{ $p->isi }}</p>
                        </div>
                    </div>
                </x-card>
            @empty
                <x-card class="p-8 text-center text-gray-600">Belum ada pengumuman.</x-card>
            @endforelse

            <div>{{ $daftar->links() }}</div>
        </div>
    </div>
</x-app-layout>