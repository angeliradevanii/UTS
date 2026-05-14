@extends('layouts.app')

@section('title', 'Detail balita')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Detail pemantauan</h1>
            <p class="mt-1 text-sm text-slate-600">{{ $balita->nama_anak }} — {{ $balita->nama_ibu }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('balitas.edit', $balita) }}" class="inline-flex items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-900 hover:bg-slate-50">Ubah</a>
            <form method="post" action="{{ route('balitas.destroy', $balita) }}" onsubmit="return confirm('Hapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-rose-600 px-4 py-2 text-sm font-medium text-white hover:bg-rose-700">Hapus</button>
            </form>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nama balita</p>
                    <p class="mt-1 text-base text-slate-900">{{ $balita->nama_anak }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Jenis kelamin</p>
                    <p class="mt-1 text-base text-slate-900">{{ $balita->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tanggal lahir</p>
                    <p class="mt-1 text-base text-slate-900">{{ $balita->tanggal_lahir->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tanggal kunjungan</p>
                    <p class="mt-1 text-base text-slate-900">{{ $balita->tanggal_kunjungan->format('d/m/Y') }}</p>
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nama ibu / orang tua</p>
                <p class="mt-1 text-base text-slate-900">{{ $balita->nama_ibu }}</p>
            </div>
        </div>

        <div class="space-y-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Antropometri</p>
                <ul class="mt-2 space-y-2 text-sm text-slate-800">
                    <li><span class="font-medium text-slate-600">BB:</span> {{ $balita->berat_badan_kg }} kg</li>
                    <li><span class="font-medium text-slate-600">TB:</span> {{ $balita->tinggi_badan_cm }} cm</li>
                    <li><span class="font-medium text-slate-600">LK:</span> {{ $balita->lingkar_kepala_cm !== null ? $balita->lingkar_kepala_cm.' cm' : '—' }}</li>
                </ul>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Imunisasi / intervensi</p>
                <p class="mt-1 text-sm text-slate-800">{{ $balita->imunisasi ?: '—' }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status gizi</p>
                @php
                    $badge = match ($balita->status_gizi) {
                        'baik' => 'bg-emerald-100 text-emerald-900 ring-emerald-600/20',
                        'kurang' => 'bg-amber-100 text-amber-900 ring-amber-600/20',
                        'obesitas' => 'bg-violet-100 text-violet-900 ring-violet-600/20',
                        'stunting' => 'bg-rose-100 text-rose-900 ring-rose-600/20',
                        default => 'bg-slate-100 text-slate-800 ring-slate-600/15',
                    };
                @endphp
                <p class="mt-2">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium ring-1 ring-inset {{ $badge }}">
                        {{ ucfirst($balita->status_gizi) }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Catatan kader</p>
                <p class="mt-1 whitespace-pre-line text-sm text-slate-800">{{ $balita->catatan ?: '—' }}</p>
            </div>
            <div class="border-t border-slate-100 pt-4 text-xs text-slate-500">
                Dibuat: {{ $balita->created_at?->format('d/m/Y H:i') }}<br>
                Diperbarui: {{ $balita->updated_at?->format('d/m/Y H:i') }}
            </div>
            <a href="{{ route('balitas.index') }}" class="inline-flex w-full justify-center rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Kembali ke daftar</a>
        </div>
    </div>
@endsection
