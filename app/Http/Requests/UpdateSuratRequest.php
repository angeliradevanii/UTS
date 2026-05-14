<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSuratRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $surat = $this->route('surat');

        return [
            'nomor_surat' => [
                'required',
                'string',
                'max:50',
                Rule::unique('surats', 'nomor_surat')->ignore($surat),
            ],
            'jenis_surat' => ['required', 'string', 'max:120'],
            'nama_warga' => ['required', 'string', 'max:150'],
            'nik' => ['nullable', 'string', 'max:20', 'regex:/^[0-9]*$/'],
            'rt_rw' => ['nullable', 'string', 'max:32'],
            'kontak' => ['nullable', 'string', 'max:32'],
            'keperluan' => ['required', 'string', 'max:2000'],
            'status' => ['required', 'in:diajukan,diproses,selesai,ditolak'],
            'prioritas' => ['required', 'in:normal,penting,darurat'],
            'tanggal_surat' => ['required', 'date'],
            'catatan_admin' => ['nullable', 'string', 'max:2000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nomor_surat' => 'nomor surat',
            'jenis_surat' => 'jenis surat',
            'nama_warga' => 'nama warga',
            'rt_rw' => 'RT/RW',
            'kontak' => 'kontak',
            'keperluan' => 'keperluan',
            'tanggal_surat' => 'tanggal surat',
            'catatan_admin' => 'catatan admin',
        ];
    }
}
