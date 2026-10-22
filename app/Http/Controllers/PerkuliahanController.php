<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Perkuliahan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PerkuliahanController extends Controller
{
    private const HARI = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    // Prefix route = role user ("admin" atau "dosen")
    private function prefix(): string
    {
        return auth()->user()->role;
    }

    private function isAdmin(): bool
    {
        return auth()->user()->role === 'admin';
    }

    // Dosen hanya boleh mengelola jadwal dari mata kuliah yang dia ampu
    private function authorizePerkuliahan(Perkuliahan $perkuliahan): void
    {
        if (! $this->isAdmin() && $perkuliahan->mataKuliah->dosen_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke jadwal ini.');
        }
    }

    // Admin: semua mata kuliah. Dosen: hanya yang dia ampu.
    private function mataKuliahOptions()
    {
        $query = MataKuliah::orderBy('nama');

        if (! $this->isAdmin()) {
            $query->where('dosen_id', auth()->id());
        }

        return $query->get();
    }

    private function rules(): array
    {
        $mataKuliahRule = Rule::exists('mata_kuliah', 'id');

        if (! $this->isAdmin()) {
            $mataKuliahRule = $mataKuliahRule->where('dosen_id', auth()->id());
        }

        return [
            'mata_kuliah_id' => ['required', $mataKuliahRule],
            'hari' => ['required', Rule::in(self::HARI)],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'ruangan' => ['required', 'string', 'max:100'],
            'semester' => ['nullable', 'string', 'max:50'],
        ];
    }

    // Cegah dua kuliah memakai ruangan yang sama di hari dan jam yang bertabrakan
    private function ensureRoomIsFree(array $data, ?Perkuliahan $ignore = null): void
    {
        $bentrok = Perkuliahan::where('hari', $data['hari'])
            ->where('ruangan', $data['ruangan'])
            ->where('jam_mulai', '<', $data['jam_selesai'])
            ->where('jam_selesai', '>', $data['jam_mulai'])
            ->when($ignore, fn ($q) => $q->where('id', '!=', $ignore->id))
            ->exists();

        if ($bentrok) {
            throw ValidationException::withMessages([
                'ruangan' => 'Ruangan sudah dipakai pada hari dan jam tersebut.',
            ]);
        }
    }

    public function index(): View
    {
        $query = Perkuliahan::with('mataKuliah.dosen')
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai');

        if (! $this->isAdmin()) {
            $query->whereHas('mataKuliah', fn ($q) => $q->where('dosen_id', auth()->id()));
        }

        return view('perkuliahan.index', [
            'daftar' => $query->get(),
            'prefix' => $this->prefix(),
        ]);
    }

    public function create(): View
    {
        return view('perkuliahan.create', [
            'perkuliahan' => new Perkuliahan(),
            'mataKuliahList' => $this->mataKuliahOptions(),
            'hariList' => self::HARI,
            'prefix' => $this->prefix(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $this->ensureRoomIsFree($data);

        Perkuliahan::create($data);

        return redirect()->route($this->prefix().'.perkuliahan.index')
            ->with('success', 'Jadwal perkuliahan berhasil ditambahkan.');
    }

    public function edit(Perkuliahan $perkuliahan): View
    {
        $this->authorizePerkuliahan($perkuliahan);

        return view('perkuliahan.edit', [
            'perkuliahan' => $perkuliahan,
            'mataKuliahList' => $this->mataKuliahOptions(),
            'hariList' => self::HARI,
            'prefix' => $this->prefix(),
        ]);
    }

    public function update(Request $request, Perkuliahan $perkuliahan): RedirectResponse
    {
        $this->authorizePerkuliahan($perkuliahan);

        $data = $request->validate($this->rules());
        $this->ensureRoomIsFree($data, $perkuliahan);

        $perkuliahan->update($data);

        return redirect()->route($this->prefix().'.perkuliahan.index')
            ->with('success', 'Jadwal perkuliahan berhasil diperbarui.');
    }

    public function destroy(Perkuliahan $perkuliahan): RedirectResponse
    {
        $this->authorizePerkuliahan($perkuliahan);

        $perkuliahan->delete();

        return redirect()->route($this->prefix().'.perkuliahan.index')
            ->with('success', 'Jadwal perkuliahan berhasil dihapus.');
    }
}