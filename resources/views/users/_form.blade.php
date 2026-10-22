<div class="space-y-4" x-data="{ role: '{{ old('role', $user->role) }}' }">
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

    <div>
        <x-input-label for="role" value="Role" />
        <select id="role" name="role" x-model="role"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                @disabled($user->exists && $user->id === auth()->id())>
            @foreach ($roles as $r)
                <option value="{{ $r }}" @selected(old('role', $user->role) === $r)>{{ ucfirst($r) }}</option>
            @endforeach
        </select>
        @if ($user->exists && $user->id === auth()->id())
            <p class="mt-1 text-xs text-gray-500">Role akun yang sedang Anda pakai tidak bisa diubah.</p>
        @endif
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    {{-- KRS: hanya tampil untuk mahasiswa --}}
    <div x-show="role === 'mhs'">
        <x-input-label value="Mata Kuliah yang Diambil (KRS)" />
        <div class="mt-2 space-y-2 max-h-64 overflow-y-auto border rounded-md p-3">
            @forelse ($mataKuliahList as $mk)
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="mata_kuliah_ids[]" value="{{ $mk->id }}"
                           class="rounded border-gray-300"
                           @checked(in_array($mk->id, old('mata_kuliah_ids', $selectedIds)))>
                    {{ $mk->kode }} - {{ $mk->nama }}
                </label>
            @empty
                <p class="text-sm text-gray-500">Belum ada mata kuliah.</p>
            @endforelse
        </div>
        <x-input-error :messages="$errors->get('mata_kuliah_ids')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Simpan</x-primary-button>
        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
    </div>
</div>