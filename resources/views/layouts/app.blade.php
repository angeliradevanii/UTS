<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Posyandu KIA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-sky-50 text-slate-900 antialiased">
    <header class="border-b border-sky-200 bg-white">
        <div class="mx-auto flex max-w-5xl flex-col gap-3 px-4 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a href="{{ route('balitas.index') }}" class="text-lg font-semibold tracking-tight text-slate-900 hover:text-sky-700">
                    Posyandu — Pemantauan Balita
                </a>
                <p class="text-sm text-slate-600">Pencatatan antropometri, imunisasi, dan status gizi (CRUD).</p>
            </div>
            <nav class="flex flex-wrap items-center gap-2 text-sm">
                <a class="rounded-md px-3 py-2 text-slate-700 hover:bg-sky-100" href="{{ route('balitas.index') }}">Daftar</a>
                <a class="rounded-md bg-sky-600 px-3 py-2 font-medium text-white shadow-sm hover:bg-sky-700" href="{{ route('balitas.create') }}">Input kunjungan</a>
            </nav>
        </div>
    </header>

    @if (session('ok'))
        <div class="mx-auto max-w-5xl px-4 pt-4">
            <div class="rounded-lg border border-sky-200 bg-sky-50 px-4 py-3 text-sm text-sky-950">
                {{ session('ok') }}
            </div>
        </div>
    @endif

    <main class="mx-auto max-w-5xl px-4 py-8">
        @yield('content')
    </main>
</body>
</html>
