<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portal Akademik</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white font-sans text-gray-900 antialiased">
        <!-- Header -->
        <header class="border-b border-gray-100 bg-white">
            <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <a href="/" class="flex items-center gap-2">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white">
                        <x-icon name="book" class="h-5 w-5" />
                    </span>
                    <span class="font-semibold text-gray-900">Portal Akademik</span>
                </a>

                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-lg px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-100">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                           class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                            Daftar
                        </a>
                    @endauth
                </nav>
            </div>
        </header>

        <!-- Hero -->
        <section class="bg-indigo-50">
            <div class="mx-auto max-w-6xl px-4 py-16 text-center sm:px-6 sm:py-24 lg:px-8">
                <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-xs font-medium text-indigo-700 shadow-sm">
                    Sistem Informasi Akademik
                </span>
                <h1 class="mx-auto mt-5 max-w-3xl text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                    Kelola perkuliahan lebih mudah dalam satu portal
                </h1>
                <p class="mx-auto mt-5 max-w-2xl text-base text-gray-600 sm:text-lg">
                    Jadwal kuliah, jadwal ujian, mata kuliah, dan pengumuman kampus
                    tersedia untuk admin, dosen, dan mahasiswa di satu tempat.
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                           class="rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
                            Daftar sebagai Mahasiswa
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Fitur -->
        <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-2xl font-bold text-gray-900">Yang bisa kamu lakukan</h2>
                <p class="mt-2 text-gray-600">Semua informasi perkuliahan yang kamu butuhkan.</p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                        <x-icon name="calendar" class="h-6 w-6" />
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Jadwal Perkuliahan</h3>
                    <p class="mt-1 text-sm text-gray-500">Lihat jadwal kelas mingguan lengkap dengan jam, dosen, dan ruangan.</p>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                        <x-icon name="document" class="h-6 w-6" />
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Jadwal Ujian</h3>
                    <p class="mt-1 text-sm text-gray-500">Pantau jadwal UTS dan UAS dari mata kuliah yang kamu ambil.</p>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                        <x-icon name="bell" class="h-6 w-6" />
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Informasi Kampus</h3>
                    <p class="mt-1 text-sm text-gray-500">Baca pengumuman dan berita terbaru seputar perkuliahan.</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-gray-100">
            <div class="mx-auto max-w-6xl px-4 py-6 text-center text-sm text-gray-500 sm:px-6 lg:px-8">
                &copy; {{ date('Y') }} Portal Akademik
            </div>
        </footer>
    </body>
</html>