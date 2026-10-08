<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RekapSiswaController extends Controller
{
    public function exportPdf(Request $request)
    {
        $bulan = $request->query('bulan', Carbon::now()->month);
        $tahun = $request->query('tahun', Carbon::now()->year);
        $user = Auth::user();

        $absensi = Absensi::with('mesin')
            ->where('nomor_induk', $user->nomor_induk)
            ->whereMonth('absen', $bulan)
            ->whereYear('absen', $tahun)
            ->orderBy('absen', 'asc')
            ->get();

        return view('absensi.rekap_pdf', compact('absensi', 'user', 'bulan', 'tahun'));
    }

    public function exportExcel(Request $request)
    {
        $bulan = $request->query('bulan', Carbon::now()->month);
        $tahun = $request->query('tahun', Carbon::now()->year);
        $user = Auth::user();

        $absensi = Absensi::with('mesin')
            ->where('nomor_induk', $user->nomor_induk)
            ->whereMonth('absen', $bulan)
            ->whereYear('absen', $tahun)
            ->orderBy('absen', 'asc')
            ->get();

        $filename = "Rekap_Absensi_{$user->nama}_{$bulan}_{$tahun}.csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No', 'Tanggal', 'Jam', 'Kategori', 'Metode Absen'];

        $callback = function() use($absensi, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            $no = 1;
            foreach ($absensi as $row) {
                $tanggal = Carbon::parse($row->absen)->format('d-m-Y');
                $jam = Carbon::parse($row->absen)->format('H:i:s');
                $kategori = '';
                switch ($row->kategori) {
                    case 1: $kategori = 'Masuk'; break;
                    case 2: $kategori = 'Mulai Istirahat'; break;
                    case 3: $kategori = 'Selesai Istirahat'; break;
                    case 4: $kategori = 'Pulang'; break;
                }
                
                fputcsv($file, [$no++, $tanggal, $jam, $kategori, $row->idmesin ? 'Mesin' : 'Web']);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
