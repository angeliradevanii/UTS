@php
    /** @var \App\Models\Surat|null $surat */
    $editing = $surat;
@endphp

@if ($errors->any())
    <div class="mb-6 rounded-2xl border border-rose-200/80 bg-rose-50 px-4 py-4 text-sm text-rose-950 shadow-sm ring-1 ring-rose-600/10">
        <p class="font-semibold">Periksa kembali input:</p>
        <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ $editing ? route('surats.update', $editing) : route('surats.store') }}" class="space-y-8">
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <section class="rounded-2xl border border-white/80 bg-white/95 p-6 shadow-sm ring-1 ring-slate-200/60">
        <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Identitas surat</h2>
                <p class="text-sm text-slate-600">Nomor unik, jenis, tanggal, dan prioritas penanganan.</p>
            </div>
            @if (! $editing && isset($suggestedNomor))
                <p class="text-xs text-slate-500">Usulan nomor: <span class="font-mono font-semibold text-slate-800">{{ $suggestedNomor }}</span></p>
            @endif
        </div>

        <div class="mt-6 grid gap-5 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="nomor_surat">Nomor surat</label>
                <input id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $editing?->nomor_surat ?? ($suggestedNomor ?? '')) }}"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 font-mono text-sm shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    required>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="jenis_surat">Jenis surat</label>
                <input id="jenis_surat" name="jenis_surat" list="jenis-list" value="{{ old('jenis_surat', $editing?->jenis_surat) }}"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    required>
                <datalist id="jenis-list">
                    <option value="Keterangan domisili"></option>
                    <option value="Pengantar nikah"></option>
                    <option value="Keterangan tidak mampu"></option>
                    <option value="Izin keramaian"></option>
                    <option value="Keterangan usaha (SKU)"></option>
                    <option value="Surat keterangan kelakuan baik"></option>
                </datalist>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="tanggal_surat">Tanggal surat</label>
                <input id="tanggal_surat" type="date" name="tanggal_surat" value="{{ old('tanggal_surat', $editing?->tanggal_surat?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    required>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="status">Status proses</label>
                <select id="status" name="status"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    required>
                    @foreach (['diajukan', 'diproses', 'selesai', 'ditolak'] as $st)
                        <option value="{{ $st }}" @selected(old('status', $editing?->status ?? 'diajukan') === $st)>
                            {{ ucfirst($st) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="prioritas">Prioritas</label>
                <select id="prioritas" name="prioritas"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    required>
                    @foreach (['normal', 'penting', 'darurat'] as $pr)
                        <option value="{{ $pr }}" @selected(old('prioritas', $editing?->prioritas ?? 'normal') === $pr)>
                            {{ ucfirst($pr) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </section>

    <section class="rounded-2xl border border-white/80 bg-white/95 p-6 shadow-sm ring-1 ring-slate-200/60">
        <div class="border-b border-slate-100 pb-4">
            <h2 class="text-base font-bold text-slate-900">Data pemohon</h2>
            <p class="text-sm text-slate-600">Nama warga, NIK, RT/RW, dan kontak untuk koordinasi.</p>
        </div>

        <div class="mt-6 grid gap-5 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="nama_warga">Nama warga</label>
                <input id="nama_warga" name="nama_warga" value="{{ old('nama_warga', $editing?->nama_warga) }}"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    required>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="nik">NIK (opsional)</label>
                <input id="nik" name="nik" inputmode="numeric" pattern="[0-9]*" value="{{ old('nik', $editing?->nik) }}"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 font-mono text-sm shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    placeholder="16 digit angka">
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="rt_rw">RT / RW (opsional)</label>
                <input id="rt_rw" name="rt_rw" value="{{ old('rt_rw', $editing?->rt_rw) }}"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    placeholder="Contoh: 003/009">
            </div>

            <div class="sm:col-span-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="kontak">Kontak (opsional)</label>
                <input id="kontak" name="kontak" value="{{ old('kontak', $editing?->kontak) }}"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    placeholder="WhatsApp / telepon">
            </div>
        </div>
    </section>

    <section class="rounded-2xl border border-white/80 bg-white/95 p-6 shadow-sm ring-1 ring-slate-200/60">
        <div class="border-b border-slate-100 pb-4">
            <h2 class="text-base font-bold text-slate-900">Isi & catatan</h2>
            <p class="text-sm text-slate-600">Ringkas keperluan dan catatan internal kelurahan.</p>
        </div>

        <div class="mt-6 grid gap-5">
            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="keperluan">Keperluan</label>
                <textarea id="keperluan" name="keperluan" rows="4"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm leading-relaxed shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4"
                    required>{{ old('keperluan', $editing?->keperluan) }}</textarea>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500" for="catatan_admin">Catatan admin (opsional)</label>
                <textarea id="catatan_admin" name="catatan_admin" rows="3"
                    class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm leading-relaxed shadow-inner outline-none ring-emerald-500/25 focus:border-emerald-400 focus:ring-4">{{ old('catatan_admin', $editing?->catatan_admin) }}</textarea>
            </div>
        </div>
    </section>

    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
        <a href="{{ route('surats.index') }}" class="inline-flex justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-800 shadow-sm hover:bg-slate-50">Batal</a>
        <button type="submit" class="inline-flex justify-center rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-emerald-600/25 ring-1 ring-emerald-700/20 hover:bg-emerald-700">
            {{ $editing ? 'Simpan perubahan' : 'Simpan surat' }}
        </button>
    </div>
</form>
