<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $month = $request->get('month', Carbon::now()->month);
        $year  = $request->get('year', Carbon::now()->year);

        // ambil hak akses dari tabel jabatan_status
        $hakAkses = DB::table('jabatan_status')
            ->where('id', $user->jabatan_status)
            ->value('hak_akses');

        /**
         * ===============================
         * ADMIN / PIMPINAN
         * ===============================
         */
        // hak_akses 2 adalah 'Full' (Admin), sementara hak_akses 1 adalah 'Nusabot' (Siswa/User)
        // Kita sesuaikan logikanya di sini agar Admin memuat view dashboard.index
        if (in_array($hakAkses, [2]) || str_contains(strtolower($user->tag), 'admin')) {

            $cabangGedungId = $request->get('cabangGedung');

            $cabangGedungList = DB::table('cabang_gedung')->get();

            $lokasiCabang = $cabangGedungId
                ? DB::table('cabang_gedung')
                    ->where('id', $cabangGedungId)
                    ->value('lokasi')
                : 'Semua Cabang';

            $stats = $this->getMonthlyStats(
                $month,
                $year,
                $cabangGedungId,
                null // ❗ tidak filter user
            );

            return view('dashboard.index', [
                'cabangGedungList' => $cabangGedungList,
                'labels'          => $stats['labels'],
                'tepatWaktu'      => $stats['tepat'],
                'terlambat'       => $stats['telat'],
                'lokasiCabang'    => $lokasiCabang,
                'cabangGedungId'  => $cabangGedungId ?? null,
                // Passing nilai 1 agar Filter Cabang di view dashboard.index tetap muncul
                // (karena di view ada pengecekan if (in_array($hakAkses, [0, 1])))
                'hakAkses'        => 1
            ]);
        }
        /**
         * ===============================
         * USER BIASA / SISWA
         * ===============================
         */
        else {
            // Logika Dashboard Siswa
            $nomorInduk = $user->nomor_induk;

            // 2. $totalHariMasuk: count presensi bulan ini dengan status 'hadir' (kategori 1 = masuk)
            $totalHariMasuk = Absensi::where('nomor_induk', $nomorInduk)
                ->whereMonth('absen', $month)
                ->whereYear('absen', $year)
                ->where('kategori', 1)
                ->count();

            // 3. $totalHariEfektif: total hari berjalan di bulan ini
            $totalHariEfektif = Carbon::now()->day;

            // 4. $persentaseKehadiran: persentase tepat waktu
            $persentaseKehadiran = ($totalHariMasuk / max($totalHariEfektif, 1)) * 100;

            // 5. $riwayatTerbaru: ambil 5 data terakhir dari tabel presensi khusus user login
            $riwayatTerbaru = Absensi::where('nomor_induk', $nomorInduk)
                ->orderBy('absen', 'desc')
                ->take(5)
                ->get();

            // Process $riwayatTerbaru to get status
            foreach ($riwayatTerbaru as $riwayat) {
                if (empty($riwayat->absen)) continue;
                
                $waktuAbsen = Carbon::parse($riwayat->absen);
                
                $kategoriLabel = '-';
                if ($riwayat->kategori == 1) $kategoriLabel = 'Presensi Masuk';
                elseif ($riwayat->kategori == 2) $kategoriLabel = 'Mulai Istirahat';
                elseif ($riwayat->kategori == 3) $kategoriLabel = 'Selesai Istirahat';
                elseif ($riwayat->kategori == 4) $kategoriLabel = 'Presensi Pulang';
                
                $riwayat->kategori_label = $kategoriLabel;
                
                // default jam
                $defaultJam = [
                    '1' => '08:00:00',
                    '2' => '12:00:00',
                    '3' => '13:00:00',
                    '4' => '17:00:00',
                ];
                
                $jamTarget = $defaultJam[$riwayat->kategori] ?? null;
                $riwayat->status_label = 'Tepat Waktu';
                
                if ($jamTarget) {
                    $target = Carbon::parse($waktuAbsen->toDateString() . ' ' . $jamTarget);
                    
                    if ($riwayat->kategori == 1) { // Masuk
                        if ($waktuAbsen->greaterThan($target->copy()->addMinutes(15))) {
                            $selisih = $waktuAbsen->diffInMinutes($target);
                            $riwayat->status_label = "Terlambat $selisih Menit";
                        }
                    } elseif ($riwayat->kategori == 4) { // Pulang
                        if ($waktuAbsen->lessThan($target)) {
                            $riwayat->status_label = "Pulang Cepat";
                        }
                    }
                }
                
                // Check if it's Izin / Sakit logic? Cuti table handles Izin/Sakit. 
                // But if they just mean based on kategori string, we handle it if needed.
            }

            if ($hakAkses == 4) { // Orang Tua
                return view('dashboard.orangtua', [
                    'totalHariMasuk' => $totalHariMasuk,
                    'totalHariEfektif' => $totalHariEfektif,
                    'persentaseKehadiran' => $persentaseKehadiran,
                    'riwayatTerbaru' => $riwayatTerbaru,
                    'hakAkses' => $hakAkses
                ]);
            }

            return view('dashboard.siswa', [
                'totalHariMasuk' => $totalHariMasuk,
                'totalHariEfektif' => $totalHariEfektif,
                'persentaseKehadiran' => $persentaseKehadiran,
                'riwayatTerbaru' => $riwayatTerbaru,
                'hakAkses' => $hakAkses
            ]);
        }
    }

    /**
     * =====================================
     * GRAFIK ABSEN MASUK BULANAN
     * kategori = 1
     * =====================================
     */
    private function getMonthlyStats(
        $month,
        $year,
        $cabangGedungId = null,
        $userNomorInduk = null
    ) {
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        $labels    = range(1, $daysInMonth);
        $dataTepat = array_fill(0, $daysInMonth, 0);
        $dataTelat = array_fill(0, $daysInMonth, 0);

        $query = Absensi::query()
            ->where('kategori', 1)
            ->whereMonth('absen', $month)
            ->whereYear('absen', $year)
            ->whereNotNull('absen');

        // ✅ FILTER USER LOGIN (PALING PENTING)
        if ($userNomorInduk) {
            $query->where('nomor_induk', $userNomorInduk);
        }

        // ✅ FILTER CABANG (ADMIN)
        if ($cabangGedungId) {
            $query->whereHas('pengguna', function ($q) use ($cabangGedungId) {
                $q->where('cabang_gedung', $cabangGedungId);
            });
        }

        foreach ($query->get() as $row) {

            $waktuAbsen = Carbon::parse($row->absen);
            $hariIndex  = (int)$waktuAbsen->format('d') - 1;

            $jamMasuk = Carbon::parse(
                $waktuAbsen->toDateString() . ' 08:00:00'
            );

            if ($waktuAbsen->lte($jamMasuk)) {
                $dataTepat[$hariIndex]++;
            } else {
                $dataTelat[$hariIndex]++;
            }
        }

        return [
            'labels' => $labels,
            'tepat'  => $dataTepat,
            'telat'  => $dataTelat,
        ];
    }
}
