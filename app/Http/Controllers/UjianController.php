<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Ujian;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

// Hanya diakses admin (route dilindungi middleware role:admin)
class UjianController extends Controller
{
    private const JENIS = ['UTS', 'UAS'];

    private function rules(?Ujian $ujian = null): array
    {
        return [
            'mata_kuliah_id' => ['required', 'exists:mata_kuliah,id'],
            // Satu mata kuliah hanya boleh punya satu UTS dan satu UAS
            'jenis' => [
                'required',
                Rule::in(self::JENIS),
                Rule::unique('ujian', 'jenis')
                    ->where('mata_kuliah_id', request('mata_kuliah_id'))
                    ->ignore($ujian?->id),
            ],
            'tanggal' => ['required', 'date'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'ruangan' => ['required', 'string', 'max:100'],
        ];
    }

    // Cegah dua ujian memakai ruangan yang sama di tanggal dan jam yang bertabrakan
    private function ensureRoomIsFree(array $data, ?Ujian $ignore = null): void
    {
        $bentrok = Ujian::whereDate('tanggal', $data['tanggal'])
            ->where('ruangan', $data['ruangan'])
            ->where('jam_mulai', '<', $data['jam_selesai'])
            ->where('jam_selesai', '>', $data['jam_mulai'])
            ->when($ignore, fn ($q) => $q->where('id', '!=', $ignore->id))
            ->exists();

        if ($bentrok) {
            throw ValidationException::withMessages([
                'ruangan' => 'Ruangan sudah dipakai ujian lain pada tanggal dan jam tersebut.',
            ]);
        }
    }

    public function index(): View
    {
        return view('ujian.index', [
            'daftar' => Ujian::with('mataKuliah')->orderBy('tanggal')->orderBy('jam_mulai')->get(),
        ]);
    }

    public function create(): View
    {
        return view('ujian.create', [
            'ujian' => new Ujian(),
            'mataKuliahList' => MataKuliah::orderBy('nama')->get(),
            'jenisList' => self::JENIS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $this->ensureRoomIsFree($data);

        Ujian::create($data);

        return redirect()->route('admin.ujian.index')
            ->with('success', 'Jadwal ujian berhasil ditambahkan.');
    }

    public function edit(Ujian $ujian): View
    {
        return view('ujian.edit', [
            'ujian' => $ujian,
            'mataKuliahList' => MataKuliah::orderBy('nama')->get(),
            'jenisList' => self::JENIS,
        ]);
    }

    public function update(Request $request, Ujian $ujian): RedirectResponse
    {
        $data = $request->validate($this->rules($ujian));
        $this->ensureRoomIsFree($data, $ujian);

        $ujian->update($data);

        return redirect()->route('admin.ujian.index')
            ->with('success', 'Jadwal ujian berhasil diperbarui.');
    }

    public function destroy(Ujian $ujian): RedirectResponse
    {
        $ujian->delete();

        return redirect()->route('admin.ujian.index')
            ->with('success', 'Jadwal ujian berhasil dihapus.');
    }
}