<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Portal Akademik</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-indigo-50 px-4 py-10">
            <a href="/" class="flex flex-col items-center gap-3">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-md">
                    <x-icon name="book" class="h-8 w-8" />
                </span>
                <span class="text-center">
                    <span class="block text-xl font-bold text-gray-900">Portal Akademik</span>
                    <span class="block text-sm text-gray-500">Sistem informasi perkuliahan</span>
                </span>
            </a>

            <div class="mt-8 w-full overflow-hidden rounded-2xl border border-gray-100 bg-white px-6 py-8 shadow-lg sm:max-w-md sm:px-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>