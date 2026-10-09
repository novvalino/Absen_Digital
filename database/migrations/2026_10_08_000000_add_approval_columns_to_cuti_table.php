<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Menghubungkan pengajuan izin/sakit siswa dengan admin.
 * Admin dapat menyetujui / menolak, dan keputusan tercatat.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            if (!Schema::hasColumn('cuti', 'disetujui_oleh')) {
                $table->char('disetujui_oleh', 30)->nullable()->after('status_persetujuan');
                $table->foreign('disetujui_oleh')
                    ->references('nomor_induk')
                    ->on('pengguna')
                    ->nullOnDelete();
            }
            if (!Schema::hasColumn('cuti', 'tanggal_keputusan')) {
                $table->dateTime('tanggal_keputusan')->nullable()->after('disetujui_oleh');
            }
            if (!Schema::hasColumn('cuti', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable()->after('tanggal_keputusan');
            }
            $table->index('status_persetujuan', 'cuti_status_persetujuan_index');
        });

        // Data lama (dibuat langsung oleh admin, bukan pengajuan siswa) otomatis dianggap Disetujui,
        // supaya tetap dihitung sebagai cuti di rekap absensi.
        DB::table('cuti')
            ->whereNull('kategori')
            ->update([
                'status_persetujuan' => 'Disetujui',
                'tanggal_mulai'      => DB::raw('tanggal'),
                'tanggal_selesai'    => DB::raw('tanggal'),
            ]);
    }

    public function down(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->dropIndex('cuti_status_persetujuan_index');
            $table->dropForeign(['disetujui_oleh']);
            $table->dropColumn(['disetujui_oleh', 'tanggal_keputusan', 'catatan_admin']);
        });
    }
};
