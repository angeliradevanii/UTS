@php
    /** @var \App\Models\Balita|null $balita */
    $editing = $balita;
@endphp

@if ($errors->any())
    <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-900">
        <p class="font-semibold">Periksa kembali input:</p>
        <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ $editing ? route('balitas.update', $editing) : route('balitas.store') }}" class="space-y-6">
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label class="block text-sm font-medium text-slate-800" for="nama_anak">Nama balita</label>
            <input id="nama_anak" name="nama_anak" value="{{ old('nama_anak', $editing?->nama_anak) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="nama_ibu">Nama ibu / orang tua</label>
            <input id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $editing?->nama_ibu) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="tanggal_lahir">Tanggal lahir</label>
            <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $editing?->tanggal_lahir?->format('Y-m-d')) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="jenis_kelamin">Jenis kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                required>
                <option value="L" @selected(old('jenis_kelamin', $editing?->jenis_kelamin) === 'L')>Laki-laki</option>
                <option value="P" @selected(old('jenis_kelamin', $editing?->jenis_kelamin) === 'P')>Perempuan</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="tanggal_kunjungan">Tanggal kunjungan</label>
            <input id="tanggal_kunjungan" type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', $editing?->tanggal_kunjungan?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="berat_badan_kg">Berat badan (kg)</label>
            <input id="berat_badan_kg" type="number" step="0.01" min="0" name="berat_badan_kg" value="{{ old('berat_badan_kg', $editing?->berat_badan_kg) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="tinggi_badan_cm">Tinggi badan (cm)</label>
            <input id="tinggi_badan_cm" type="number" step="0.01" min="0" name="tinggi_badan_cm" value="{{ old('tinggi_badan_cm', $editing?->tinggi_badan_cm) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="lingkar_kepala_cm">Lingkar kepala (cm, opsional)</label>
            <input id="lingkar_kepala_cm" type="number" step="0.01" min="0" name="lingkar_kepala_cm" value="{{ old('lingkar_kepala_cm', $editing?->lingkar_kepala_cm) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="imunisasi">Imunisasi / intervensi (opsional)</label>
            <input id="imunisasi" name="imunisasi" list="imun-list" value="{{ old('imunisasi', $editing?->imunisasi) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200">
            <datalist id="imun-list">
                <option value="BCG"></option>
                <option value="HB-0"></option>
                <option value="DPT-HB-Hib 1"></option>
                <option value="Polio 1"></option>
                <option value="MR (campak-rubella)"></option>
                <option value="Vitamin A"></option>
            </datalist>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="status_gizi">Status gizi (KPS)</label>
            <select id="status_gizi" name="status_gizi"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                required>
                @foreach (['baik', 'kurang', 'obesitas', 'stunting'] as $sg)
                    <option value="{{ $sg }}" @selected(old('status_gizi', $editing?->status_gizi ?? 'baik') === $sg)>
                        {{ ucfirst($sg) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="sm:col-span-2">
            <label class="block text-sm font-medium text-slate-800" for="catatan">Catatan kader (opsional)</label>
            <textarea id="catatan" name="catatan" rows="3"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200">{{ old('catatan', $editing?->catatan) }}</textarea>
        </div>
    </div>

    <div class="flex flex-col-reverse gap-2 sm:flex-row sm:items-center sm:justify-between">
        <a href="{{ route('balitas.index') }}" class="inline-flex justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-800 hover:bg-slate-50">Batal</a>
        <button type="submit" class="inline-flex justify-center rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-sky-700">
            {{ $editing ? 'Simpan perubahan' : 'Simpan data' }}
        </button>
    </div>
</form>
