@extends('layouts.app')

@section('title', 'Cuti')

@section('content')
@php
    use App\Models\Cuti;
    $tabs = [
        ['key' => null,              'label' => 'Semua',     'count' => $jumlah['semua']],
        ['key' => Cuti::PENDING,     'label' => 'Menunggu',  'count' => $jumlah['pending']],
        ['key' => Cuti::DISETUJUI,   'label' => 'Disetujui', 'count' => $jumlah['disetujui']],
        ['key' => Cuti::DITOLAK,     'label' => 'Ditolak',   'count' => $jumlah['ditolak']],
    ];
@endphp
<div class="page-wrap">

    {{-- HEADER --}}
    <div class="page-head">
        <div class="ph-icon"><i class="bi bi-calendar-event-fill"></i></div>
        <div class="ph-text">
            <h2>Manajemen Cuti & Izin</h2>
            <p>Setujui atau tolak pengajuan izin/sakit siswa, dan kelola cuti secara efisien</p>
        </div>
        <a href="{{ route('cuti.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Cuti
        </a>
    </div>

    @include('partials.flash')

    {{-- FILTER STATUS --}}
    <div class="chips" style="margin-bottom:.9rem">
        @foreach ($tabs as $t)
            @php $aktif = $status === $t['key']; @endphp
            <a href="{{ route('cuti.index', $t['key'] ? ['status' => $t['key']] : []) }}"
               class="badge-soft {{ $aktif ? 'indigo' : 'gray' }}" style="text-decoration:none">
                {{ $t['label'] }} ({{ $t['count'] }})
            </a>
        @endforeach
    </div>

    {{-- TABEL --}}
    <div class="data-card">
        <table id="cutiTable" class="table-stack">
            <thead>
                <tr>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Alasan</th>
                    <th class="text-center no-export no-sort">Bukti</th>
                    <th class="text-center">Status</th>
                    <th class="text-center no-export no-sort" style="width:15rem">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuti as $item)
                    @php
                        $mulai   = \Carbon\Carbon::parse($item->tanggal_mulai ?? $item->tanggal);
                        $selesai = \Carbon\Carbon::parse($item->tanggal_selesai ?? $item->tanggal);
                        $st      = $item->status_persetujuan ?? Cuti::PENDING;
                        $dariSiswa = !empty($item->kategori) && $item->kategori !== 'Cuti';
                    @endphp
                    <tr>
                        <td data-label="Nomor Induk"><span class="mono">{{ $item->nomor_induk }}</span></td>
                        <td data-label="Nama"><span class="cell-main">{{ $item->pengguna->nama ?? '-' }}</span></td>
                        <td data-label="Kategori">
                            <span class="badge-soft {{ strtolower($item->kategori ?? '') === 'sakit' ? 'amber' : 'indigo' }}">
                                {{ $item->kategori ?: 'Cuti' }}
                            </span>
                        </td>
                        <td data-label="Tanggal" data-order="{{ $mulai->format('Y-m-d') }}" class="whitespace-nowrap">
                            <span class="inline-flex items-center gap-2">
                                <i class="bi bi-calendar-event" style="color:#6366f1"></i>
                                @if ($mulai->isSameDay($selesai))
                                    {{ $mulai->locale('id')->translatedFormat('d F Y') }}
                                @else
                                    {{ $mulai->locale('id')->translatedFormat('d M Y') }} – {{ $selesai->locale('id')->translatedFormat('d M Y') }}
                                @endif
                            </span>
                        </td>
                        <td data-label="Alasan" style="max-width:16rem">
                            <span title="{{ $item->alasan }}">{{ \Illuminate\Support\Str::limit($item->alasan ?? '-', 60) }}</span>
                        </td>
                        <td data-label="Bukti" class="text-center">
                            @if (!empty($item->bukti_file))
                                <a href="{{ asset('storage/' . $item->bukti_file) }}" target="_blank" rel="noopener" class="act edit">
                                    <i class="bi bi-paperclip"></i> Lihat
                                </a>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td data-label="Status" class="text-center">
                            @if ($st === Cuti::DISETUJUI)
                                <span class="badge-soft green dot">Disetujui</span>
                            @elseif ($st === Cuti::DITOLAK)
                                <span class="badge-soft red dot">Ditolak</span>
                            @else
                                <span class="badge-soft amber dot">Menunggu</span>
                            @endif
                            @if ($st !== Cuti::PENDING && $item->penyetuju)
                                <div class="text-xs text-slate-500" style="margin-top:.2rem">
                                    oleh {{ $item->penyetuju->nama }}
                                    @if ($item->tanggal_keputusan)
                                        · {{ $item->tanggal_keputusan->locale('id')->translatedFormat('d M Y') }}
                                    @endif
                                </div>
                            @endif
                            @if ($st === Cuti::DITOLAK && $item->catatan_admin)
                                <div class="text-xs text-slate-500" title="{{ $item->catatan_admin }}">
                                    Catatan: {{ \Illuminate\Support\Str::limit($item->catatan_admin, 40) }}
                                </div>
                            @endif
                        </td>
                        <td class="td-actions text-center">
                            <div class="act-group">
                                @if ($dariSiswa && $st !== Cuti::DISETUJUI)
                                    <form action="{{ route('cuti.setujui', ['id' => $item->id, 'status' => $status]) }}" method="POST"
                                          onsubmit="return confirm('Setujui pengajuan ini?')">
                                        @csrf
                                        <button type="submit" class="act edit"><i class="bi bi-check-lg"></i> Setujui</button>
                                    </form>
                                @endif
                                @if ($dariSiswa && $st !== Cuti::DITOLAK)
                                    <form action="{{ route('cuti.tolak', ['id' => $item->id, 'status' => $status]) }}" method="POST"
                                          onsubmit="var c = prompt('Alasan penolakan (wajib diisi):'); if (!c || !c.trim()) { return false; } this.catatan_admin.value = c.trim(); return true;">
                                        @csrf
                                        <input type="hidden" name="catatan_admin" value="">
                                        <button type="submit" class="act warn"><i class="bi bi-x-lg"></i> Tolak</button>
                                    </form>
                                @endif
                                @unless ($dariSiswa)
                                    <a href="{{ route('cuti.edit', $item->id) }}" class="act edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                @endunless
                                <form action="{{ route('cuti.destroy', $item->id) }}" method="POST"
                                    data-confirm="Hapus data cuti ini?"
                                    onsubmit="return confirm(this.dataset.confirm)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="act del"><i class="bi bi-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/data-table.js') }}?v={{ @filemtime(public_path('js/data-table.js')) }}"></script>
<script>
    $(function () {
        initDataTable('#cutiTable', { title: 'Data Cuti dan Izin', order: [[3, 'desc']], emptyText: 'Belum ada data cuti' });
    });
</script>
@endpush
