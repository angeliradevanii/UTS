@extends('layouts.app')

@section('title', 'Detail surat')

@section('content')
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700/90">Detail arsip</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">{{ $surat->nomor_surat }}</h1>
            <p class="mt-2 text-sm text-slate-600">{{ $surat->jenis_surat }} — tanggal surat <span class="font-medium text-slate-800 tabular-nums">{{ $surat->tanggal_surat->format('d/m/Y') }}</span></p>
            <div class="mt-3 flex flex-wrap items-center gap-2">
                <x-surat-status-badge :status="$surat->status" />
                <x-surat-priority-badge :prioritas="$surat->prioritas ?? 'normal'" />
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('surats.edit', $surat) }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50">Ubah</a>
            <form method="post" action="{{ route('surats.destroy', $surat) }}" onsubmit="return confirm('Hapus surat ini secara permanen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-rose-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-700">Hapus</button>
            </form>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-5 lg:col-span-2">
            <div class="rounded-2xl border border-white/80 bg-white/95 p-6 shadow-sm ring-1 ring-slate-200/60">
                <h2 class="text-sm font-bold uppercase tracking-wide text-slate-500">Pemohon</h2>
                <p class="mt-2 text-xl font-semibold text-slate-900">{{ $surat->nama_warga }}</p>
                <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">NIK</dt>
                        <dd class="mt-1 font-mono text-sm text-slate-900">{{ $surat->nik ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">RT / RW</dt>
                        <dd class="mt-1 text-sm text-slate-900">{{ $surat->rt_rw ?: '—' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kontak</dt>
                        <dd class="mt-1 text-sm text-slate-900">{{ $surat->kontak ?: '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="rounded-2xl border border-white/80 bg-white/95 p-6 shadow-sm ring-1 ring-slate-200/60">
                <h2 class="text-sm font-bold uppercase tracking-wide text-slate-500">Keperluan</h2>
                <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-800">{{ $surat->keperluan }}</p>
            </div>
        </div>

        <div class="space-y-5">
            <div class="rounded-2xl border border-emerald-100 bg-gradient-to-b from-emerald-50/90 to-white p-6 shadow-sm ring-1 ring-emerald-200/50">
                <h2 class="text-sm font-bold uppercase tracking-wide text-emerald-900/80">Catatan kelurahan</h2>
                <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-800">{{ $surat->catatan_admin ?: 'Belum ada catatan admin.' }}</p>
            </div>

            <div class="rounded-2xl border border-white/80 bg-white/95 p-6 text-xs text-slate-500 shadow-sm ring-1 ring-slate-200/60">
                <p><span class="font-semibold text-slate-700">Dibuat:</span> {{ $surat->created_at?->format('d/m/Y H:i') }}</p>
                <p class="mt-1"><span class="font-semibold text-slate-700">Diperbarui:</span> {{ $surat->updated_at?->format('d/m/Y H:i') }}</p>
            </div>

            <a href="{{ route('surats.index') }}" class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow hover:bg-slate-800">Kembali ke daftar</a>
        </div>
    </div>
@endsection
