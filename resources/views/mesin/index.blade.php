@extends('layouts.app')

@section('title', 'Mesin')

@section('content')
<div class="page-wrap">

    {{-- HEADER --}}
    <div class="page-head">
        <div class="ph-icon"><i class="bi bi-cpu-fill"></i></div>
        <div class="ph-text">
            <h2>Daftar Mesin</h2>
            <p>Kelola mesin absensi dan cabang penempatannya</p>
        </div>
        <a href="{{ route('mesin.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Mesin
        </a>
    </div>

    @include('partials.flash')

    {{-- TABEL --}}
    <div class="data-card">
        <table id="mesinTable" class="table-stack">
            <thead>
                <tr>
                    <th>Kode Mesin</th>
                    <th>Cabang</th>
                    <th>Keterangan</th>
                    <th class="text-center no-export no-sort" style="width:8rem">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mesin as $row)
                    <tr>
                        <td data-label="Kode Mesin"><span class="cell-main mono">{{ $row->idmesin }}</span></td>
                        <td data-label="Cabang">{{ $row->cabangGedung->lokasi ?? '-' }}</td>
                        <td data-label="Keterangan">{{ $row->keterangan ?: '-' }}</td>
                        <td class="td-actions text-center">
                            <div class="act-group">
                                <a href="{{ route('mesin.edit', $row->idmesin) }}" class="act edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
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
        initDataTable('#mesinTable', { title: 'Daftar Mesin', order: [[0, 'desc']], emptyText: 'Belum ada data mesin' });
    });
</script>
@endpush
