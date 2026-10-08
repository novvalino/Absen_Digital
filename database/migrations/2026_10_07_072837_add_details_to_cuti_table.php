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
        Schema::table('cuti', function (Blueprint $table) {
            $table->date('tanggal_mulai')->nullable()->after('tanggal');
            $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
            $table->string('kategori')->nullable()->after('tanggal_selesai'); // 'Izin' or 'Sakit'
            $table->text('alasan')->nullable()->after('kategori');
            $table->string('bukti_file')->nullable()->after('alasan');
            $table->string('status_persetujuan')->default('Pending')->after('bukti_file'); // 'Pending', 'Disetujui', 'Ditolak'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_mulai',
                'tanggal_selesai',
                'kategori',
                'alasan',
                'bukti_file',
                'status_persetujuan'
            ]);
        });
    }
};
