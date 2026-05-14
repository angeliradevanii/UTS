<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuratRequest;
use App\Http\Requests\UpdateSuratRequest;
use App\Models\Surat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuratController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');
        $sort = (string) $request->query('sort', 'terbaru');

        $allowedStatus = ['diajukan', 'diproses', 'selesai', 'ditolak'];
        if (! in_array($status, $allowedStatus, true)) {
            $status = '';
        }

        $allowedSort = ['terbaru', 'terlama', 'nomor'];
        if (! in_array($sort, $allowedSort, true)) {
            $sort = 'terbaru';
        }

        $surats = Surat::query()
            ->search($q)
            ->status($status !== '' ? $status : null)
            ->urutkan($sort)
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total' => Surat::query()->count(),
            'diajukan' => Surat::query()->where('status', 'diajukan')->count(),
            'diproses' => Surat::query()->where('status', 'diproses')->count(),
            'selesai' => Surat::query()->where('status', 'selesai')->count(),
            'ditolak' => Surat::query()->where('status', 'ditolak')->count(),
        ];

        return view('surats.index', compact('surats', 'q', 'status', 'sort', 'stats'));
    }

    public function create(): View
    {
        return view('surats.create', [
            'suggestedNomor' => Surat::nextNomorSurat(),
        ]);
    }

    public function store(StoreSuratRequest $request): RedirectResponse
    {
        Surat::create($request->validated());

        return redirect()
            ->route('surats.index')
            ->with('ok', 'Surat berhasil ditambahkan.');
    }

    public function show(Surat $surat): View
    {
        return view('surats.show', compact('surat'));
    }

    public function edit(Surat $surat): View
    {
        return view('surats.edit', compact('surat'));
    }

    public function update(UpdateSuratRequest $request, Surat $surat): RedirectResponse
    {
        $surat->update($request->validated());

        return redirect()
            ->route('surats.show', $surat)
            ->with('ok', 'Data surat diperbarui.');
    }

    public function destroy(Surat $surat): RedirectResponse
    {
        $surat->delete();

        return redirect()
            ->route('surats.index')
            ->with('ok', 'Surat dihapus.');
    }
}
