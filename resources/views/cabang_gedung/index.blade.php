@extends('layouts.app')

@section('title', 'Cabang / Gedung')

@section('content')
@php
    $namaHari = [0 => 'Min', 1 => 'Sen', 2 => 'Sel', 3 => 'Rab', 4 => 'Kam', 5 => 'Jum', 6 => 'Sab'];
    $namaZona = [1 => 'WIB', 2 => 'WITA', 3 => 'WIT'];
    $jam = fn ($t) => $t ? substr($t, 0, 5) : '-';
@endphp

<div class="page-wrap">

    {{-- HEADER --}}
    <div class="page-head">
        <div class="ph-icon"><i class="bi bi-buildings-fill"></i></div>
        <div class="ph-text">
            <h2>Cabang / Gedung</h2>
            <p>Kelola lokasi, jam kerja, dan hari libur tiap cabang</p>
        </div>
        <a href="{{ route('cabang-gedung.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Cabang
        </a>
    </div>

    @include('partials.flash')

    {{-- TABEL --}}
    <div class="data-card">
        <div class="data-scroll">
            <table id="cabangTable" class="table-stack">
                <thead>
                    <tr>
                        <th>Lokasi</th>
                        <th>Jam Kerja</th>
                        <th>Istirahat</th>
                        <th>Hari Libur</th>
                        <th>Zona</th>
                        <th>Status</th>
                        <th class="text-center no-export no-sort" style="width:15rem">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        @php
                            $libur = collect(explode(',', (string) $row->hari_libur))
                                ->filter(fn ($h) => $h !== '' && isset($namaHari[(int) $h]))
                                ->map(fn ($h) => $namaHari[(int) $h]);
                        @endphp
                        <tr>
                            <td data-label="Lokasi"><span class="cell-main">{{ $row->lokasi }}</span></td>
                            <td data-label="Jam Kerja" class="whitespace-nowrap mono">{{ $jam($row->jam_masuk) }} – {{ $jam($row->jam_pulang) }}</td>
                            <td data-label="Istirahat" class="whitespace-nowrap mono">{{ $jam($row->istirahat_mulai) }} – {{ $jam($row->istirahat_selesai) }}</td>
                            <td data-label="Hari Libur">
                                @if ($libur->isEmpty())
                                    <span class="muted">Tidak ada</span>
                                @else
                                    <div class="chips">
                                        @foreach ($libur as $h)
                                            <span class="chip">{{ $h }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td data-label="Zona"><span class="badge-soft indigo">{{ $namaZona[$row->zona_waktu] ?? 'WIT' }}</span></td>
                            <td data-label="Status">
                                <span class="badge-soft dot {{ $row->aktif ? 'green' : 'red' }}">
                                    {{ $row->aktif ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="td-actions text-center">
                                <div class="act-group">
                                    <a href="{{ route('cabang-gedung.edit', $row->id) }}" class="act edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('cabang-gedung.destroy', $row->id) }}"
                                        data-confirm="{{ $row->aktif ? 'Nonaktifkan' : 'Aktifkan' }} cabang &quot;{{ $row->lokasi }}&quot;?"
                                        onsubmit="return confirm(this.dataset.confirm)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="act act-wide {{ $row->aktif ? 'warn' : 'edit' }}">
                                            <i class="bi {{ $row->aktif ? 'bi-toggle-on' : 'bi-toggle-off' }}"></i>
                                            {{ $row->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/data-table.js') }}?v={{ @filemtime(public_path('js/data-table.js')) }}"></script>
<script>
    $(function () {
        initDataTable('#cabangTable', { title: 'Cabang Gedung', order: [[0, 'asc']], emptyText: 'Belum ada data cabang' });
    });
</script>
@endpush
