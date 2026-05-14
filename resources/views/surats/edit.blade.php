@extends('layouts.app')

@section('title', 'Ubah surat')

@section('content')
    <div class="mb-8">
        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700/90">Perbarui data</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Ubah surat</h1>
        <p class="mt-2 text-sm text-slate-600">Nomor: <span class="font-mono font-semibold text-slate-900">{{ $surat->nomor_surat }}</span></p>
    </div>

    <div class="rounded-2xl border border-white/80 bg-white/95 p-6 shadow-md ring-1 ring-slate-200/60 sm:p-8">
        @include('surats._form', ['surat' => $surat])
    </div>
@endsection
