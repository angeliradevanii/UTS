@extends('layouts.app')

@section('title', 'Beranda — Daftar surat')

@section('content')
    <div class="mb-8 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700/90">Kelurahan</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Daftar surat</h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600">
                Ringkasan arsip, filter status, dan pencarian cepat untuk nomor surat, nama warga, jenis surat, RT/RW, atau kontak.
            </p>
        </div>
        <a href="{{ route('surats.create') }}" class="inline-flex items-center justify-center gap-2 self-start rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-600/25 ring-1 ring-emerald-700/20 transition hover:bg-emerald-700">
            <span class="text-lg leading-none">+</span> Tambah surat
        </a>
    </div>

    <div class="mb-8 grid gap-3 sm:grid-cols-2 lg:grid-cols-5">
        @php
            $cards = [
                ['key' => 'total', 'label' => 'Total arsip', 'value' => $stats['total'], 'accent' => 'from-slate-900 to-slate-700'],
                ['key' => 'diajukan', 'label' => 'Diajukan', 'value' => $stats['diajukan'], 'accent' => 'from-slate-600 to-slate-500'],
                ['key' => 'diproses', 'label' => 'Diproses', 'value' => $stats['diproses'], 'accent' => 'from-amber-600 to-amber-500'],
                ['key' => 'selesai', 'label' => 'Selesai', 'value' => $stats['selesai'], 'accent' => 'from-emerald-600 to-teal-500'],
                ['key' => 'ditolak', 'label' => 'Ditolak', 'value' => $stats['ditolak'], 'accent' => 'from-rose-600 to-rose-500'],
            ];
        @endphp
        @foreach ($cards as $c)
            <div class="rounded-2xl border border-white/80 bg-white/90 p-4 shadow-sm ring-1 ring-slate-200/60 backdrop-blur">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">{{ $c['label'] }}</p>
                <p class="mt-2 text-3xl font-bold tabular-nums text-slate-900">{{ $c['value'] }}</p>
                <div class="mt-3 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                    <div class="h-full w-full rounded-full bg-gradient-to-r {{ $c['accent'] }} opacity-90"></div>
                </div>
            </div>
        @endforeach
    </div>

    <form method="get" action="{{ route('surats.index') }}" class="mb-6 rounded-2xl border border-white/80 bg-white/90 p-4 shadow-sm ring-1 ring-slate-200/60 backdrop-blur">
        <div class="grid gap-4 lg:grid-cols-12 lg:items-end">
            <div class="lg:col-span-5">
                <label for="q" class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pencarian</label>
                <input
                    id="q"
                    type="search"
                    name="q"
                    value="{{ $q }}"
                    placeholder="Nomor, nama, jenis, RT/RW, kontak…"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/30 transition focus:border-emerald-400 focus:ring-4"
                >
            </div>
            <div class="lg:col-span-3">
                <label for="status" class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status</label>
                <select
                    id="status"
                    name="status"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/30 transition focus:border-emerald-400 focus:ring-4"
                >
                    <option value="" @selected($status === '')>Semua status</option>
                    <option value="diajukan" @selected($status === 'diajukan')>Diajukan</option>
                    <option value="diproses" @selected($status === 'diproses')>Diproses</option>
                    <option value="selesai" @selected($status === 'selesai')>Selesai</option>
                    <option value="ditolak" @selected($status === 'ditolak')>Ditolak</option>
                </select>
            </div>
            <div class="lg:col-span-3">
                <label for="sort" class="text-xs font-semibold uppercase tracking-wide text-slate-500">Urutkan</label>
                <select
                    id="sort"
                    name="sort"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/30 transition focus:border-emerald-400 focus:ring-4"
                >
                    <option value="terbaru" @selected($sort === 'terbaru')>Tanggal surat terbaru</option>
                    <option value="terlama" @selected($sort === 'terlama')>Tanggal surat terlama</option>
                    <option value="nomor" @selected($sort === 'nomor')>Nomor surat (A–Z)</option>
                </select>
            </div>
            <div class="flex flex-wrap gap-2 lg:col-span-1 lg:justify-end">
                <button type="submit" class="rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow hover:bg-slate-800">Terapkan</button>
                @if ($q !== '' || $status !== '' || $sort !== 'terbaru')
                    <a href="{{ route('surats.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-800 hover:bg-slate-50">Reset</a>
                @endif
            </div>
        </div>
    </form>

    <div class="overflow-hidden rounded-2xl border border-white/80 bg-white/95 shadow-md ring-1 ring-slate-200/60">
        <div class="overflow-x-auto">
            <table class="min-w-[720px] w-full divide-y divide-slate-100 text-sm">
                <thead>
                    <tr class="bg-slate-50/90 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                        <th class="px-4 py-3">Surat</th>
                        <th class="px-4 py-3">Warga</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Prioritas</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($surats as $surat)
                        <tr class="transition hover:bg-emerald-50/40">
                            <td class="px-4 py-4">
                                <p class="font-semibold text-slate-900">{{ $surat->nomor_surat }}</p>
                                <p class="mt-0.5 text-xs text-slate-600">{{ $surat->jenis_surat }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <p class="font-medium text-slate-900">{{ $surat->nama_warga }}</p>
                                @if ($surat->rt_rw)
                                    <p class="mt-0.5 text-xs text-slate-500">RT/RW {{ $surat->rt_rw }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-slate-600 tabular-nums">{{ $surat->tanggal_surat->format('d/m/Y') }}</td>
                            <td class="px-4 py-4">
                                <x-surat-priority-badge :prioritas="$surat->prioritas ?? 'normal'" />
                            </td>
                            <td class="px-4 py-4">
                                <x-surat-status-badge :status="$surat->status" />
                            </td>
                            <td class="px-4 py-4 text-right">
                                <a class="inline-flex items-center justify-center rounded-lg bg-emerald-600/10 px-3 py-1.5 text-xs font-semibold text-emerald-800 ring-1 ring-emerald-600/20 hover:bg-emerald-600/15" href="{{ route('surats.show', $surat) }}">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-14 text-center">
                                <p class="text-base font-semibold text-slate-800">Belum ada surat</p>
                                <p class="mt-1 text-sm text-slate-600">Ubah filter atau tambahkan surat pertama.</p>
                                <a href="{{ route('surats.create') }}" class="mt-4 inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Tambah surat</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $surats->onEachSide(1)->links() }}
    </div>
@endsection
