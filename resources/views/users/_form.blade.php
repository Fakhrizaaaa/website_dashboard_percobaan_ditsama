<div class="space-y-5" x-data="{ role: '{{ old('role', $user->role) }}' }">
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <div>
            <x-input-label for="name" value="Nama" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', $user->name)" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                          autocomplete="new-password" :required="! $user->exists" />
            @if ($user->exists)
                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengganti password.</p>
            @endif
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                          class="mt-1 block w-full" autocomplete="new-password" :required="! $user->exists" />
        </div>
    </div>

    <div>
        <x-input-label for="role" value="Role" />
        <x-select-input id="role" name="role" x-model="role" class="mt-1"
                         :disabled="$user->exists && $user->id === auth()->id()">
            @foreach ($roles as $r)
                <option value="{{ $r }}" @selected(old('role', $user->role) === $r)>{{ ucfirst($r) }}</option>
            @endforeach
        </x-select-input>
        @if ($user->exists && $user->id === auth()->id())
            <p class="mt-1 text-xs text-gray-500">Role akun yang sedang Anda pakai tidak bisa diubah.</p>
        @endif
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    {{-- KRS: hanya tampil untuk mahasiswa --}}
    <div x-show="role === 'mhs'">
        <x-input-label value="Mata Kuliah yang Diambil (KRS)" />
        <div class="mt-2 max-h-64 space-y-1 overflow-y-auto rounded-lg border border-gray-200 p-2">
            @forelse ($mataKuliahList as $mk)
                <label class="flex cursor-pointer items-center gap-3 rounded-md px-2 py-1.5 text-sm hover:bg-gray-50">
                    <input type="checkbox" name="mata_kuliah_ids[]" value="{{ $mk->id }}"
                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                           @checked(in_array($mk->id, old('mata_kuliah_ids', $selectedIds)))>
                    <span><span class="font-medium text-gray-900">{{ $mk->kode }}</span> - {{ $mk->nama }}</span>
                </label>
            @empty
                <p class="px-2 py-1.5 text-sm text-gray-500">Belum ada mata kuliah.</p>
            @endforelse
        </div>
        <x-input-error :messages="$errors->get('mata_kuliah_ids')" class="mt-2" />
    </div>

    <div class="flex items-center gap-3 border-t border-gray-100 pt-5">
        <x-primary-button>Simpan</x-primary-button>
        <x-link-button variant="secondary" :href="route('admin.users.index')">Batal</x-link-button>
    </div>
</div>