@extends('layouts.app')

@section('title', 'Tambah surat')

@section('content')
    <div class="mb-8">
        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700/90">Entri baru</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Tambah surat</h1>
        <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600">Nomor surat sudah diusulkan otomatis; Anda tetap bisa mengubahnya sebelum menyimpan.</p>
    </div>

    <div class="rounded-2xl border border-white/80 bg-white/95 p-6 shadow-md ring-1 ring-slate-200/60 sm:p-8">
        @include('surats._form', ['surat' => null, 'suggestedNomor' => $suggestedNomor])
    </div>
@endsection
