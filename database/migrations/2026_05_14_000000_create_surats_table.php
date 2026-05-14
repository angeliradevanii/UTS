<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->string('jenis_surat');
            $table->string('nama_warga');
            $table->string('nik', 32)->nullable();
            $table->text('keperluan');
            $table->string('status', 32)->default('diajukan');
            $table->date('tanggal_surat');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
