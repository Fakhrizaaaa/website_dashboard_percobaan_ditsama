<div class="space-y-4">
    <div>
        <x-input-label for="judul" value="Judul" />
        <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full"
                      :value="old('judul', $pengumuman->judul)" required />
        <x-input-error :messages="$errors->get('judul')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="isi" value="Isi Pengumuman" />
        <textarea id="isi" name="isi" rows="8" required
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('isi', $pengumuman->isi) }}</textarea>
        <x-input-error :messages="$errors->get('isi')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Simpan</x-primary-button>
        <a href="{{ route('admin.pengumuman.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
    </div>
</div>