<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BalitaController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $balitas = Balita::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nama_anak', 'like', '%'.$q.'%')
                        ->orWhere('nama_ibu', 'like', '%'.$q.'%')
                        ->orWhere('imunisasi', 'like', '%'.$q.'%');
                });
            })
            ->orderByDesc('tanggal_kunjungan')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('balitas.index', compact('balitas', 'q'));
    }

    public function create(): View
    {
        return view('balitas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_anak' => ['required', 'string', 'max:150'],
            'nama_ibu' => ['required', 'string', 'max:150'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'tanggal_kunjungan' => ['required', 'date'],
            'berat_badan_kg' => ['required', 'numeric', 'min:0', 'max:200'],
            'tinggi_badan_cm' => ['required', 'numeric', 'min:0', 'max:250'],
            'lingkar_kepala_cm' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'imunisasi' => ['nullable', 'string', 'max:200'],
            'status_gizi' => ['required', 'in:baik,kurang,obesitas,stunting'],
            'catatan' => ['nullable', 'string', 'max:2000'],
        ]);

        Balita::create($data);

        return redirect()
            ->route('balitas.index')
            ->with('ok', 'Data kunjungan balita berhasil ditambahkan.');
    }

    public function show(Balita $balita): View
    {
        return view('balitas.show', compact('balita'));
    }

    public function edit(Balita $balita): View
    {
        return view('balitas.edit', compact('balita'));
    }

    public function update(Request $request, Balita $balita): RedirectResponse
    {
        $data = $request->validate([
            'nama_anak' => ['required', 'string', 'max:150'],
            'nama_ibu' => ['required', 'string', 'max:150'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'tanggal_kunjungan' => ['required', 'date'],
            'berat_badan_kg' => ['required', 'numeric', 'min:0', 'max:200'],
            'tinggi_badan_cm' => ['required', 'numeric', 'min:0', 'max:250'],
            'lingkar_kepala_cm' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'imunisasi' => ['nullable', 'string', 'max:200'],
            'status_gizi' => ['required', 'in:baik,kurang,obesitas,stunting'],
            'catatan' => ['nullable', 'string', 'max:2000'],
        ]);

        $balita->update($data);

        return redirect()
            ->route('balitas.show', $balita)
            ->with('ok', 'Data pemantauan diperbarui.');
    }

    public function destroy(Balita $balita): RedirectResponse
    {
        $balita->delete();

        return redirect()
            ->route('balitas.index')
            ->with('ok', 'Data dihapus.');
    }
}
