<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cuti extends Model
{
    public const PENDING   = 'Pending';
    public const DISETUJUI = 'Disetujui';
    public const DITOLAK   = 'Ditolak';

    protected $table = 'cuti';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nomor_induk',
        'tanggal',
        'tanggal_mulai',
        'tanggal_selesai',
        'kategori',
        'alasan',
        'bukti_file',
        'status_persetujuan',
        'disetujui_oleh',
        'tanggal_keputusan',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal'           => 'date',
        'tanggal_mulai'     => 'date',
        'tanggal_selesai'   => 'date',
        'tanggal_keputusan' => 'datetime',
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'nomor_induk', 'nomor_induk');
    }

    /** Admin yang memutuskan (menyetujui / menolak). */
    public function penyetuju(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'disetujui_oleh', 'nomor_induk');
    }

    public function scopeTanggalRange($query, $start, $end)
    {
        return $query->whereBetween('tanggal', [$start, $end]);
    }

    public function scopeByNomorInduk($query, $nomorInduk)
    {
        return $query->where('nomor_induk', $nomorInduk);
    }

    public function scopePending($query)
    {
        return $query->where('status_persetujuan', self::PENDING);
    }

    public function scopeDisetujui($query)
    {
        return $query->where('status_persetujuan', self::DISETUJUI);
    }

    /**
     * Daftar tanggal (Y-m-d) izin/sakit/cuti yang SUDAH DISETUJUI untuk satu pengguna
     * dalam rentang $start s/d $end. Pengajuan berentang (tanggal_mulai - tanggal_selesai)
     * dijabarkan per hari; data lama cukup memakai kolom `tanggal`.
     */
    public static function tanggalDisetujui(string $nomorInduk, $start, $end): array
    {
        $start = Carbon::parse($start)->startOfDay();
        $end   = Carbon::parse($end)->startOfDay();

        $rows = static::byNomorInduk($nomorInduk)
            ->disetujui()
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('tanggal', [$start->toDateString(), $end->toDateString()])
                  ->orWhere(function ($q2) use ($start, $end) {
                      $q2->whereDate('tanggal_mulai', '<=', $end->toDateString())
                         ->whereDate('tanggal_selesai', '>=', $start->toDateString());
                  });
            })
            ->get();

        $dates = [];
        foreach ($rows as $row) {
            $from = Carbon::parse($row->tanggal_mulai ?? $row->tanggal)->startOfDay();
            $to   = Carbon::parse($row->tanggal_selesai ?? $row->tanggal)->startOfDay();

            if ($from->lt($start)) $from = $start->copy();
            if ($to->gt($end))     $to   = $end->copy();
            if ($from->gt($to))    continue;

            foreach (CarbonPeriod::create($from, $to) as $day) {
                $dates[$day->format('Y-m-d')] = true;
            }
        }

        return array_keys($dates);
    }
}
