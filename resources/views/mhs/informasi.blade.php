<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Informasi Kampus</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @forelse ($daftar as $p)
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-rose-700">{{ $p->judul }}</h3>
                    <p class="text-xs text-gray-500 mb-3">
                        {{ $p->created_at->format('d-m-Y H:i') }}
                        @if ($p->penulis) &middot; {{ $p->penulis->name }} @endif
                    </p>
                    <p class="text-sm text-gray-700 whitespace-pre-line">{{ $p->isi }}</p>
                </div>
            @empty
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-600">Belum ada pengumuman.</div>
            @endforelse

            <div>{{ $daftar->links() }}</div>
        </div>
    </div>
</x-app-layout>