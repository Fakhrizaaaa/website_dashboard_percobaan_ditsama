<div class="space-y-5">
    <div>
        <x-input-label for="judul" value="Judul" />
        <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full"
                      :value="old('judul', $pengumuman->judul)" required />
        <x-input-error :messages="$errors->get('judul')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="isi" value="Isi Pengumuman" />
        <x-textarea-input id="isi" name="isi" rows="8" class="mt-1" required>{{ old('isi', $pengumuman->isi) }}</x-textarea-input>
        <x-input-error :messages="$errors->get('isi')" class="mt-2" />
    </div>

    <div class="flex items-center gap-3 border-t border-gray-100 pt-5">
        <x-primary-button>Simpan</x-primary-button>
        <x-link-button variant="secondary" :href="route('admin.pengumuman.index')">Batal</x-link-button>
    </div>
</div>