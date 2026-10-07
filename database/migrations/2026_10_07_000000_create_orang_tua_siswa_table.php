<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orang_tua_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('orang_tua_id');
            $table->string('siswa_id');
            
            $table->foreign('orang_tua_id')->references('nomor_induk')->on('pengguna')->onDelete('cascade');
            $table->foreign('siswa_id')->references('nomor_induk')->on('pengguna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua_siswa');
    }
};
