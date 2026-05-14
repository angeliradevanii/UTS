@props(['status'])

@php
    $badge = match ($status) {
        'selesai' => 'bg-emerald-500/15 text-emerald-900 ring-emerald-600/25',
        'diproses' => 'bg-amber-500/15 text-amber-950 ring-amber-600/25',
        'ditolak' => 'bg-rose-500/15 text-rose-950 ring-rose-600/25',
        default => 'bg-slate-500/10 text-slate-800 ring-slate-600/20',
    };
    $label = match ($status) {
        'diajukan' => 'Diajukan',
        'diproses' => 'Diproses',
        'selesai' => 'Selesai',
        'ditolak' => 'Ditolak',
        default => ucfirst((string) $status),
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset '.$badge]) }}>
    {{ $label }}
</span>
