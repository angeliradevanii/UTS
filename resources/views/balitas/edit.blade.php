@extends('layouts.app')

@section('title', 'Ubah data')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Ubah data kunjungan</h1>
        <p class="mt-1 text-sm text-slate-600">{{ $balita->nama_anak }} — kunjungan {{ $balita->tanggal_kunjungan->format('d/m/Y') }}</p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('balitas._form', ['balita' => $balita])
    </div>
@endsection
