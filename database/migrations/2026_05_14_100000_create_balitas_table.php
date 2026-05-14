<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('balitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anak');
            $table->string('nama_ibu');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 1);
            $table->date('tanggal_kunjungan');
            $table->decimal('berat_badan_kg', 6, 2);
            $table->decimal('tinggi_badan_cm', 6, 2);
            $table->decimal('lingkar_kepala_cm', 6, 2)->nullable();
            $table->string('imunisasi')->nullable();
            $table->string('status_gizi', 32)->default('baik');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balitas');
    }
};
