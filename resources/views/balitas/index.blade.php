@extends('layouts.app')

@section('title', 'Daftar balita')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Daftar kunjungan balita</h1>
            <p class="mt-1 text-sm text-slate-600">Cari nama anak, ibu, atau catatan imunisasi.</p>
        </div>
        <a href="{{ route('balitas.create') }}" class="inline-flex items-center justify-center rounded-md bg-sky-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-sky-700">
            Tambah data kunjungan
        </a>
    </div>

    <form method="get" action="{{ route('balitas.index') }}" class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center">
        <input
            type="search"
            name="q"
            value="{{ $q }}"
            placeholder="Contoh: Alya, Dewi, MR..."
            class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200 sm:max-w-md"
        >
        <div class="flex gap-2">
            <button type="submit" class="rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Cari</button>
            @if ($q !== '')
                <a href="{{ route('balitas.index') }}" class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-800 hover:bg-slate-50">Reset</a>
            @endif
        </div>
    </form>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">
                <tr>
                    <th class="px-4 py-3">Nama anak</th>
                    <th class="px-4 py-3">Nama ibu</th>
                    <th class="px-4 py-3">Kunjungan</th>
                    <th class="px-4 py-3">BB / TB</th>
                    <th class="px-4 py-3">Gizi</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($balitas as $balita)
                    <tr class="hover:bg-sky-50/60">
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $balita->nama_anak }}</td>
                        <td class="px-4 py-3 text-slate-700">{{ $balita->nama_ibu }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $balita->tanggal_kunjungan->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-slate-700">{{ $balita->berat_badan_kg }} kg / {{ $balita->tinggi_badan_cm }} cm</td>
                        <td class="px-4 py-3">
                            @php
                                $badge = match ($balita->status_gizi) {
                                    'baik' => 'bg-emerald-100 text-emerald-900 ring-emerald-600/20',
                                    'kurang' => 'bg-amber-100 text-amber-900 ring-amber-600/20',
                                    'obesitas' => 'bg-violet-100 text-violet-900 ring-violet-600/20',
                                    'stunting' => 'bg-rose-100 text-rose-900 ring-rose-600/20',
                                    default => 'bg-slate-100 text-slate-800 ring-slate-600/15',
                                };
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $badge }}">
                                {{ ucfirst($balita->status_gizi) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a class="text-sky-700 hover:underline" href="{{ route('balitas.show', $balita) }}">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-slate-600">Belum ada data kunjungan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $balitas->links() }}
    </div>
@endsection
