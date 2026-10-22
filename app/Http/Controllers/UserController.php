<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

// Hanya diakses admin (route dilindungi middleware role:admin)
class UserController extends Controller
{
    private const ROLES = ['admin', 'dosen', 'mhs'];

    private function rules(?User $user = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
            'password' => [$user ? 'nullable' : 'required', 'confirmed', Password::defaults()],
            'role' => ['required', Rule::in(self::ROLES)],
            'mata_kuliah_ids' => ['nullable', 'array'],
            'mata_kuliah_ids.*' => ['integer', 'exists:mata_kuliah,id'],
        ];
    }

    // KRS hanya berlaku untuk mahasiswa
    private function syncKrs(User $user, array $data): void
    {
        if ($user->role === 'mhs') {
            $user->mataKuliahDiambil()->sync($data['mata_kuliah_ids'] ?? []);
        } else {
            $user->mataKuliahDiambil()->detach();
        }
    }

    public function index(Request $request): View
    {
        $role = $request->query('role');

        $query = User::query()
            ->withCount('mataKuliahDiambil')
            ->orderBy('role')
            ->orderBy('name');

        if (in_array($role, self::ROLES, true)) {
            $query->where('role', $role);
        }

        return view('users.index', [
            'users' => $query->paginate(15)->withQueryString(),
            'role' => $role,
            'roles' => self::ROLES,
        ]);
    }

    public function create(): View
    {
        return view('users.create', [
            'user' => new User(['role' => 'mhs']),
            'roles' => self::ROLES,
            'mataKuliahList' => MataKuliah::orderBy('nama')->get(),
            'selectedIds' => [],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge(['email' => Str::lower((string) $request->input('email'))]);

        $data = $request->validate($this->rules());

        $user = User::create(Arr::only($data, ['name', 'email', 'password', 'role']));
        $this->syncKrs($user, $data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => self::ROLES,
            'mataKuliahList' => MataKuliah::orderBy('nama')->get(),
            'selectedIds' => $user->mataKuliahDiambil()->pluck('mata_kuliah.id')->all(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        // Admin tidak boleh mengubah role dirinya sendiri (mencegah terkunci dari sistem)
        if ($user->id == auth()->id()) {
            $request->merge(['role' => $user->role]);
        }

        $request->merge(['email' => Str::lower((string) $request->input('email'))]);

        $data = $request->validate($this->rules($user));

        $user->fill(Arr::only($data, ['name', 'email', 'role']));

        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();
        $this->syncKrs($user, $data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id == auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak bisa menghapus akun yang sedang dipakai login.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}