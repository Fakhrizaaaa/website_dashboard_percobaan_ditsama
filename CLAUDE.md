# Catatan Proyek: Sistem Akademik (Laravel + Breeze)

File ini adalah ringkasan proyek untuk dibaca oleh AI (Claude) dan anggota tim.
Taruh di root repo. Di Claude Code file bernama CLAUDE.md dibaca otomatis.
Di chat Claude biasa, unggah file ini di awal percakapan.

## Gambaran umum
Web sistem akademik perkuliahan dengan 3 peran: **admin**, **dosen**, **mhs** (mahasiswa).
Stack: Laravel (Breeze, Blade, Tailwind, Alpine), MySQL (XAMPP, Windows, PowerShell).
Bahasa antarmuka dan komentar kode: Bahasa Indonesia.

## Fitur per peran (rencana asli)
- Semua: Auth (login, register, logout).
- Admin: Kelola User (admin/dosen/mhs), Kelola Mata Kuliah, Kelola Perkuliahan, Kelola Ujian.
- Dosen: Kelola Mata Kuliah, Kelola Perkuliahan.
- Mahasiswa: Landing Page, Jadwal Perkuliahan, Jadwal Ujian.
- Aturan penting: mahasiswa HANYA melihat jadwal mata kuliah yang ada di KRS-nya (tabel `krs`).

## Status
SELESAI:
- Auth + redirect `/dashboard` sesuai role (routes/web.php).
- Admin: Kelola User (termasuk pengisian KRS mahasiswa), Mata Kuliah, Perkuliahan, Ujian.
- Dosen: Mata Kuliah dan Perkuliahan (hanya milik mata kuliah yang dia ampu).

BELUM (urutan saran):
1. Halaman mahasiswa: landing page di `/mhs/dashboard`, Jadwal Perkuliahan, Jadwal Ujian (difilter dari KRS).
2. Navbar atas (resources/views/layouts/navigation.blade.php): tambah link sesuai role.
3. Kerapian: email otomatis huruf kecil di Kelola User dan Register; sesuaikan teks kartu dashboard dosen
   (menyebut presensi/jurnal/nilai yang belum ada); opsional route `/` redirect ke login.
4. Opsional: dosen melihat daftar mahasiswa per mata kuliah, pencarian di tabel, cek bentrok jadwal KRS.

## Struktur data (migration)
- `users`: name, email, password, `role` enum('admin','dosen','mhs') default 'mhs'.
- `mata_kuliah`: kode (unique), nama, sks, `dosen_id` (nullable, FK users, nullOnDelete).
- `perkuliahan`: mata_kuliah_id, hari (Senin..Sabtu), jam_mulai, jam_selesai, ruangan, semester (nullable).
- `ujian`: mata_kuliah_id, jenis ('UTS'/'UAS'), tanggal, jam_mulai, jam_selesai, ruangan.
  Satu mata kuliah hanya boleh punya satu UTS dan satu UAS.
- `krs`: user_id, mata_kuliah_id (unique pasangan). Mahasiswa mengambil mata kuliah. Diisi ADMIN lewat Kelola User.

Nama tabel Indonesia diset manual di model (`protected $table`), jangan pakai default pluralisasi Laravel.

## Model dan relasi
- `User`: `mataKuliahDiampu()` (hasMany, dosen), `mataKuliahDiambil()` (belongsToMany via `krs`, mahasiswa). `role` ada di $fillable.
- `MataKuliah`: `dosen()`, `perkuliahan()`, `ujian()`, `mahasiswa()`.
- `Perkuliahan` dan `Ujian`: `mataKuliah()`.

Contoh query jadwal mahasiswa yang sedang login:
    $mataKuliah = auth()->user()->mataKuliahDiambil()->with(['dosen', 'perkuliahan', 'ujian'])->get();

## Konvensi kode (ikuti pola yang sudah ada)
- Middleware role: alias `role` (RoleMiddleware), didaftarkan di bootstrap/app.php. Pemakaian: `['auth', 'role:admin']`.
- Route: grup per role di routes/web.php, memakai `Route::resource('admin/xxx', XxxController::class)->except('show')->names('admin.xxx')`.
  Mata kuliah dan perkuliahan didaftarkan dua kali (admin dan dosen) ke controller yang sama.
- Controller yang dipakai admin dan dosen (MataKuliahController, PerkuliahanController) menentukan prefix route
  dari `auth()->user()->role`, dan membatasi data dosen ke miliknya sendiri (abort 403 kalau bukan miliknya).
- Controller khusus admin: UserController, UjianController.
- View: folder per fitur (`resources/views/mata-kuliah`, `perkuliahan`, `ujian`, `users`) berisi
  index, create, edit, dan `_form` (partial yang dipakai create dan edit).
- Komponen Breeze yang dipakai: x-app-layout, x-input-label, x-text-input, x-input-error, x-primary-button.
- Validasi di controller (method `rules()`), pesan sukses lewat `->with('success', ...)`.
- Desain dashboard: kartu berwarna (admin: biru/hijau/ungu/kuning, dosen: indigo/teal). Pertahankan gaya ini.
- Jam di database bertipe `time` (H:i:s). Di form dan tampilan dipotong `substr($jam, 0, 5)`.
- Email harus huruf kecil (aturan `lowercase` bawaan Breeze).

## Akun seeder (php artisan migrate:fresh --seed), password semuanya `password`
- admin@example.com (admin), dosen@example.com (dosen), mhs@example.com (mahasiswa, sudah ambil Pemrograman Web)
- Ganti password sebelum dipakai sungguhan.

## Setup di komputer baru
    git clone <url-repo>
    cd <folder>
    composer install
    copy .env.example .env
    php artisan key:generate
    (edit .env: DB_DATABASE, DB_USERNAME, DB_PASSWORD; buat database di phpMyAdmin)
    php artisan migrate:fresh --seed
    npm install
    npm run dev          (terminal 1)
    php artisan serve    (terminal 2)
Setelah menarik perubahan baru yang ada migration/seeder: jalankan `php artisan migrate:fresh --seed`
(data lokal akan di-reset) lalu `php artisan optimize:clear`.

## Preferensi pemilik proyek saat bekerja dengan Claude
- Pengguna masih belajar Laravel, Windows + PowerShell + XAMPP.
- Minta kode LENGKAP siap copy-paste (satu file utuh), bukan potongan.
- Jelaskan langkah pemasangan secara berurutan: salin file ke folder mana, perintah apa yang dijalankan, cara tes.
- Jangan menimpa desain dashboard yang sudah ada tanpa meminta file aslinya dulu.
