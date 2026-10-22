<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MataKuliahController extends Controller
{
    // Prefix route = role user ("admin" atau "dosen")
    private function prefix(): string
    {
        return auth()->user()->role;
    }

    private function isAdmin(): bool
    {
        return auth()->user()->role === 'admin';
    }

    // Dosen hanya boleh mengelola mata kuliah yang dia ampu
    private function authorizeMataKuliah(MataKuliah $mataKuliah): void
    {
        if (! $this->isAdmin() && $mataKuliah->dosen_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke mata kuliah ini.');
        }
    }

    private function dosenList()
    {
        return $this->isAdmin() ? User::where('role', 'dosen')->orderBy('name')->get() : collect();
    }

    private function rules(?MataKuliah $mataKuliah = null): array
    {
        return [
            'kode' => ['required', 'string', 'max:20', Rule::unique('mata_kuliah', 'kode')->ignore($mataKuliah?->id)],
            'nama' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
            'dosen_id' => ['nullable', Rule::exists('users', 'id')->where('role', 'dosen')],
        ];
    }

    public function index(): View
    {
        $query = MataKuliah::with('dosen')->withCount('mahasiswa')->orderBy('kode');

        if (! $this->isAdmin()) {
            $query->where('dosen_id', auth()->id());
        }

        return view('mata-kuliah.index', [
            'daftar' => $query->get(),
            'prefix' => $this->prefix(),
        ]);
    }

    // Daftar mahasiswa yang mengambil mata kuliah ini (dari KRS)
    public function mahasiswa(MataKuliah $mataKuliah): View
    {
        $this->authorizeMataKuliah($mataKuliah);

        return view('mata-kuliah.mahasiswa', [
            'mataKuliah' => $mataKuliah,
            'mahasiswa' => $mataKuliah->mahasiswa()->orderBy('name')->get(),
            'prefix' => $this->prefix(),
        ]);
    }

    public function create(): View
    {
        return view('mata-kuliah.create', [
            'mataKuliah' => new MataKuliah(),
            'dosenList' => $this->dosenList(),
            'prefix' => $this->prefix(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());

        // Dosen otomatis menjadi pengampu mata kuliah yang dia buat
        if (! $this->isAdmin()) {
            $data['dosen_id'] = auth()->id();
        }

        MataKuliah::create($data);

        return redirect()->route($this->prefix().'.mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $mataKuliah): View
    {
        $this->authorizeMataKuliah($mataKuliah);

        return view('mata-kuliah.edit', [
            'mataKuliah' => $mataKuliah,
            'dosenList' => $this->dosenList(),
            'prefix' => $this->prefix(),
        ]);
    }

    public function update(Request $request, MataKuliah $mataKuliah): RedirectResponse
    {
        $this->authorizeMataKuliah($mataKuliah);

        $data = $request->validate($this->rules($mataKuliah));

        // Dosen tidak boleh memindahkan pengampu
        if (! $this->isAdmin()) {
            unset($data['dosen_id']);
        }

        $mataKuliah->update($data);

        return redirect()->route($this->prefix().'.mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah): RedirectResponse
    {
        $this->authorizeMataKuliah($mataKuliah);

        $mataKuliah->delete();

        return redirect()->route($this->prefix().'.mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }
}