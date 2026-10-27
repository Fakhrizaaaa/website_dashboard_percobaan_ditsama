@props(['action', 'method' => 'POST'])

<div class="py-8">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
        <x-card class="p-6 sm:p-8">
            <form method="POST" action="{{ $action }}">
                @csrf
                @if (strtoupper($method) !== 'POST')
                    @method($method)
                @endif

                {{ $slot }}
            </form>
        </x-card>
    </div>
</div>