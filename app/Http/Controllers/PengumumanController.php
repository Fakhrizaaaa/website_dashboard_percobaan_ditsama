<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// Hanya diakses admin (route dilindungi middleware role:admin)
class PengumumanController extends Controller
{
    private function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string', 'max:5000'],
        ];
    }

    public function index(): View
    {
        return view('pengumuman.index', [
            'daftar' => Pengumuman::with('penulis')->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('pengumuman.create', ['pengumuman' => new Pengumuman()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $data['user_id'] = auth()->id();

        Pengumuman::create($data);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Pengumuman $pengumuman): View
    {
        return view('pengumuman.edit', ['pengumuman' => $pengumuman]);
    }

    public function update(Request $request, Pengumuman $pengumuman): RedirectResponse
    {
        $pengumuman->update($request->validate($this->rules()));

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman): RedirectResponse
    {
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}