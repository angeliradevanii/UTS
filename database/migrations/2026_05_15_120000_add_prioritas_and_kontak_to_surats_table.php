<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->string('prioritas', 16)->default('normal');
            $table->string('rt_rw', 32)->nullable();
            $table->string('kontak', 32)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->dropColumn(['prioritas', 'rt_rw', 'kontak']);
        });
    }
};
