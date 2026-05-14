<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat',
        'jenis_surat',
        'nama_warga',
        'nik',
        'rt_rw',
        'kontak',
        'keperluan',
        'status',
        'prioritas',
        'tanggal_surat',
        'catatan_admin',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_surat' => 'date',
        ];
    }

    public static function nextNomorSurat(): string
    {
        $year = now()->year;
        $prefix = "SK-{$year}/";
        $max = 0;

        static::query()
            ->where('nomor_surat', 'like', $prefix.'%')
            ->pluck('nomor_surat')
            ->each(function (string $nomor) use (&$max) {
                if (preg_match('/^SK-\d{4}\/(\d+)$/', $nomor, $m)) {
                    $max = max($max, (int) $m[1]);
                }
            });

        return $prefix.str_pad((string) ($max + 1), 3, '0', STR_PAD_LEFT);
    }

    public function scopeSearch(Builder $query, string $q): Builder
    {
        if ($q === '') {
            return $query;
        }

        return $query->where(function (Builder $sub) use ($q) {
            $sub->where('nomor_surat', 'like', '%'.$q.'%')
                ->orWhere('nama_warga', 'like', '%'.$q.'%')
                ->orWhere('jenis_surat', 'like', '%'.$q.'%')
                ->orWhere('rt_rw', 'like', '%'.$q.'%')
                ->orWhere('kontak', 'like', '%'.$q.'%');
        });
    }

    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        if ($status === null || $status === '') {
            return $query;
        }

        return $query->where('status', $status);
    }

    public function scopeUrutkan(Builder $query, string $sort): Builder
    {
        return match ($sort) {
            'terlama' => $query->orderBy('tanggal_surat')->orderBy('id'),
            'nomor' => $query->orderBy('nomor_surat')->orderBy('id'),
            default => $query->orderByDesc('tanggal_surat')->orderByDesc('id'),
        };
    }

    public function labelStatus(): string
    {
        return match ($this->status) {
            'diajukan' => 'Diajukan',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => ucfirst((string) $this->status),
        };
    }

    public function labelPrioritas(): string
    {
        return match ($this->prioritas) {
            'penting' => 'Penting',
            'darurat' => 'Darurat',
            default => 'Normal',
        };
    }
}
