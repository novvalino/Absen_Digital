<!DOCTYPE html>
<html>
<head>
    <title>Rekap Absensi {{ $user->nama }} - {{ date('F', mktime(0,0,0,$bulan,1)) }} {{ $tahun }}</title>
    <style>
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            padding: 30px; 
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 { margin: 0 0 10px 0; font-size: 24px; }
        .header p { margin: 0; font-size: 14px; color: #666; }
        .info {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .info strong { display: inline-block; width: 120px; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            font-size: 14px;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 10px; 
            text-align: left; 
        }
        th { 
            background-color: #f8f9fa; 
            font-weight: bold;
        }
        tbody tr:nth-child(even) { background-color: #fbfbfb; }
        .text-center { text-align: center; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
        .print-btn {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }
        .print-btn:hover { background-color: #1d4ed8; }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button class="print-btn" onclick="window.print()">Cetak Halaman Ini</button>
    </div>
    
    <div class="header">
        <h1>LAPORAN REKAPITULASI PRESENSI</h1>
        <p>Periode: {{ date('F', mktime(0,0,0,$bulan,1)) }} {{ $tahun }}</p>
    </div>

    <div class="info">
        <div><strong>Nama Siswa</strong> : {{ $user->nama }}</div>
        <div><strong>Nomor Induk</strong> : {{ $user->nomor_induk }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="20%">Tanggal</th>
                <th width="20%">Waktu</th>
                <th width="30%">Kategori Presensi</th>
                <th width="25%">Metode</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $index => $row)
                @php
                    $tanggal = \Carbon\Carbon::parse($row->absen)->locale('id')->translatedFormat('l, d F Y');
                    $jam = \Carbon\Carbon::parse($row->absen)->format('H:i:s');
                    $kategori = '';
                    switch ($row->kategori) {
                        case 1: $kategori = 'Masuk'; break;
                        case 2: $kategori = 'Mulai Istirahat'; break;
                        case 3: $kategori = 'Selesai Istirahat'; break;
                        case 4: $kategori = 'Pulang'; break;
                    }
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $tanggal }}</td>
                    <td>{{ $jam }} WIB</td>
                    <td>{{ $kategori }}</td>
                    <td>{{ $row->idmesin ? 'Mesin RFID' : 'Web / Mandiri' }}</td>
                </tr>
            @endforeach
            @if($absensi->isEmpty())
                <tr><td colspan="5" class="text-center" style="padding: 20px;">Belum ada data presensi pada periode ini.</td></tr>
            @endif
        </tbody>
    </table>
</body>
</html>
