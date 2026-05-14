<?php

namespace Database\Seeders;

use App\Models\Balita;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Balita::query()->delete();

        $samples = [
            [
                'nama_anak' => 'Alya Putri',
                'nama_ibu' => 'Dewi Lestari',
                'tanggal_lahir' => now()->subMonths(18)->toDateString(),
                'jenis_kelamin' => 'P',
                'tanggal_kunjungan' => now()->subDays(3)->toDateString(),
                'berat_badan_kg' => 10.5,
                'tinggi_badan_cm' => 78.0,
                'lingkar_kepala_cm' => 45.0,
                'imunisasi' => 'MR (campak-rubella)',
                'status_gizi' => 'baik',
                'catatan' => 'Nafsu makan baik.',
            ],
            [
                'nama_anak' => 'Raka Pratama',
                'nama_ibu' => 'Sari Wulandari',
                'tanggal_lahir' => now()->subMonths(30)->toDateString(),
                'jenis_kelamin' => 'L',
                'tanggal_kunjungan' => now()->subDay()->toDateString(),
                'berat_badan_kg' => 11.2,
                'tinggi_badan_cm' => 86.5,
                'lingkar_kepala_cm' => null,
                'imunisasi' => 'DPT-HB-Hib 3',
                'status_gizi' => 'kurang',
                'catatan' => 'Perlu edukasi gizi tambahan.',
            ],
            [
                'nama_anak' => 'Naura Kirana',
                'nama_ibu' => 'Indah Permata',
                'tanggal_lahir' => now()->subMonths(8)->toDateString(),
                'jenis_kelamin' => 'P',
                'tanggal_kunjungan' => now()->toDateString(),
                'berat_badan_kg' => 7.8,
                'tinggi_badan_cm' => 68.0,
                'lingkar_kepala_cm' => 42.5,
                'imunisasi' => null,
                'status_gizi' => 'baik',
                'catatan' => null,
            ],
        ];

        foreach ($samples as $row) {
            Balita::create($row);
        }
    }
}
