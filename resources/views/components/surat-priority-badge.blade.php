@props(['prioritas'])

@php
    $badge = match ($prioritas) {
        'darurat' => 'bg-red-500/15 text-red-950 ring-red-600/30',
        'penting' => 'bg-orange-500/15 text-orange-950 ring-orange-600/25',
        default => 'bg-slate-500/10 text-slate-700 ring-slate-600/15',
    };
    $label = match ($prioritas) {
        'darurat' => 'Darurat',
        'penting' => 'Penting',
        default => 'Normal',
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold uppercase tracking-wide ring-1 ring-inset '.$badge]) }}>
    {{ $label }}
</span>
