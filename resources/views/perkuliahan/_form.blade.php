<div class="space-y-4">
    <div>
        <x-input-label for="mata_kuliah_id" value="Mata Kuliah" />
        <select id="mata_kuliah_id" name="mata_kuliah_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            <option value="">-- Pilih mata kuliah --</option>
            @foreach ($mataKuliahList as $mk)
                <option value="{{ $mk->id }}" @selected(old('mata_kuliah_id', $perkuliahan->mata_kuliah_id) == $mk->id)>
                    {{ $mk->kode }} - {{ $mk->nama }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('mata_kuliah_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="hari" value="Hari" />
        <select id="hari" name="hari" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            <option value="">-- Pilih hari --</option>
            @foreach ($hariList as $hari)
                <option value="{{ $hari }}" @selected(old('hari', $perkuliahan->hari) === $hari)>{{ $hari }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('hari')" class="mt-2" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="jam_mulai" value="Jam Mulai" />
            <x-text-input id="jam_mulai" name="jam_mulai" type="time" class="mt-1 block w-full"
                          :value="old('jam_mulai', substr($perkuliahan->jam_mulai ?? '', 0, 5))" required />
            <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="jam_selesai" value="Jam Selesai" />
            <x-text-input id="jam_selesai" name="jam_selesai" type="time" class="mt-1 block w-full"
                          :value="old('jam_selesai', substr($perkuliahan->jam_selesai ?? '', 0, 5))" required />
            <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-input-label for="ruangan" value="Ruangan" />
        <x-text-input id="ruangan" name="ruangan" type="text" class="mt-1 block w-full"
                      :value="old('ruangan', $perkuliahan->ruangan)" required />
        <x-input-error :messages="$errors->get('ruangan')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="semester" value="Semester / Tahun Ajaran (opsional)" />
        <x-text-input id="semester" name="semester" type="text" class="mt-1 block w-full"
                      placeholder="contoh: 2026/2027 Ganjil"
                      :value="old('semester', $perkuliahan->semester)" />
        <x-input-error :messages="$errors->get('semester')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Simpan</x-primary-button>
        <a href="{{ route($prefix.'.perkuliahan.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
    </div>
</div>