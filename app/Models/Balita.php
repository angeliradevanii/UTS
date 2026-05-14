<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    protected $fillable = [
        'nama_anak',
        'nama_ibu',
        'tanggal_lahir',
        'jenis_kelamin',
        'tanggal_kunjungan',
        'berat_badan_kg',
        'tinggi_badan_cm',
        'lingkar_kepala_cm',
        'imunisasi',
        'status_gizi',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'tanggal_kunjungan' => 'date',
            'berat_badan_kg' => 'decimal:2',
            'tinggi_badan_cm' => 'decimal:2',
            'lingkar_kepala_cm' => 'decimal:2',
        ];
    }
}
