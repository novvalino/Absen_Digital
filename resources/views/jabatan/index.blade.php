@extends('layouts.app')

@section('title', 'Jabatan')

@section('content')
<div class="page-wrap">

    {{-- HEADER --}}
    <div class="page-head">
        <div class="ph-icon"><i class="bi bi-person-badge-fill"></i></div>
        <div class="ph-text">
            <h2>Jabatan / Status</h2>
            <p>Kelola data jabatan dan hak akses</p>
        </div>
        <a href="{{ route('jabatan.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Jabatan
        </a>
    </div>

    @include('partials.flash')

    {{-- TABEL --}}
    <div class="data-card">
        <table id="jabatanTable" class="table-stack">
            <thead>
                <tr>
                    <th>Jabatan / Status</th>
                    <th>Hak Akses</th>
                    <th>Status</th>
                    <th class="text-center no-export no-sort" style="width:13rem">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td data-label="Jabatan"><span class="cell-main">{{ $row->jabatan_status }}</span></td>
                        <td data-label="Hak Akses">
                            <span class="badge-soft indigo">{{ $row->hakAkses->hak ?? 'N/A' }}</span>
                        </td>
                        <td data-label="Status">
                            <span class="badge-soft dot {{ $row->aktif ? 'green' : 'gray' }}">
                                {{ $row->aktif ? 'Aktif' : 'Non-aktif' }}
                            </span>
                        </td>
                        <td class="td-actions text-center">
                            <div class="act-group">
                                <a href="{{ route('jabatan.edit', $row->id) }}" class="act edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('jabatan.destroy', $row->id) }}" method="POST"
                                    data-confirm="Hapus jabatan &quot;{{ $row->jabatan_status }}&quot; secara permanen?"
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
        initDataTable('#jabatanTable', { title: 'Jabatan Status', pageLength: 8, emptyText: 'Belum ada data jabatan' });
    });
</script>
@endpush
