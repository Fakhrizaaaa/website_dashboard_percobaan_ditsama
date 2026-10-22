<div class="space-y-4">
    <div>
        <x-input-label for="kode" value="Kode" />
        <x-text-input id="kode" name="kode" type="text" class="mt-1 block w-full"
                      :value="old('kode', $mataKuliah->kode)" required />
        <x-input-error :messages="$errors->get('kode')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="nama" value="Nama Mata Kuliah" />
        <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                      :value="old('nama', $mataKuliah->nama)" required />
        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="sks" value="SKS" />
        <x-text-input id="sks" name="sks" type="number" min="1" max="6" class="mt-1 block w-full"
                      :value="old('sks', $mataKuliah->sks)" required />
        <x-input-error :messages="$errors->get('sks')" class="mt-2" />
    </div>

    @if ($prefix === 'admin')
        <div>
            <x-input-label for="dosen_id" value="Dosen Pengampu" />
            <select id="dosen_id" name="dosen_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Belum ditentukan --</option>
                @foreach ($dosenList as $dosen)
                    <option value="{{ $dosen->id }}" @selected(old('dosen_id', $mataKuliah->dosen_id) == $dosen->id)>
                        {{ $dosen->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('dosen_id')" class="mt-2" />
        </div>
    @endif

    <div class="flex items-center gap-4">
        <x-primary-button>Simpan</x-primary-button>
        <a href="{{ route($prefix.'.mata-kuliah.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
    </div>
</div>