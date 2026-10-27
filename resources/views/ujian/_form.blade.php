<div class="space-y-5">
    <div>
        <x-input-label for="mata_kuliah_id" value="Mata Kuliah" />
        <x-select-input id="mata_kuliah_id" name="mata_kuliah_id" class="mt-1" required>
            <option value="">-- Pilih mata kuliah --</option>
            @foreach ($mataKuliahList as $mk)
                <option value="{{ $mk->id }}" @selected(old('mata_kuliah_id', $ujian->mata_kuliah_id) == $mk->id)>
                    {{ $mk->kode }} - {{ $mk->nama }}
                </option>
            @endforeach
        </x-select-input>
        <x-input-error :messages="$errors->get('mata_kuliah_id')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <div>
            <x-input-label for="jenis" value="Jenis Ujian" />
            <x-select-input id="jenis" name="jenis" class="mt-1" required>
                <option value="">-- Pilih jenis --</option>
                @foreach ($jenisList as $jenis)
                    <option value="{{ $jenis }}" @selected(old('jenis', $ujian->jenis) === $jenis)>{{ $jenis }}</option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="tanggal" value="Tanggal" />
            <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full"
                          :value="old('tanggal', $ujian->tanggal?->format('Y-m-d'))" required />
            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <div>
            <x-input-label for="jam_mulai" value="Jam Mulai" />
            <x-text-input id="jam_mulai" name="jam_mulai" type="time" class="mt-1 block w-full"
                          :value="old('jam_mulai', substr($ujian->jam_mulai ?? '', 0, 5))" required />
            <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="jam_selesai" value="Jam Selesai" />
            <x-text-input id="jam_selesai" name="jam_selesai" type="time" class="mt-1 block w-full"
                          :value="old('jam_selesai', substr($ujian->jam_selesai ?? '', 0, 5))" required />
            <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-input-label for="ruangan" value="Ruangan" />
        <x-text-input id="ruangan" name="ruangan" type="text" class="mt-1 block w-full"
                      :value="old('ruangan', $ujian->ruangan)" required />
        <x-input-error :messages="$errors->get('ruangan')" class="mt-2" />
    </div>

    <div class="flex items-center gap-3 border-t border-gray-100 pt-5">
        <x-primary-button>Simpan</x-primary-button>
        <x-link-button variant="secondary" :href="route('admin.ujian.index')">Batal</x-link-button>
    </div>
</div>