@extends('layouts.app')

@section('title', 'Cuti')

@section('content')
<div class="page-wrap">

    {{-- HEADER --}}
    <div class="page-head">
        <div class="ph-icon"><i class="bi bi-calendar-event-fill"></i></div>
        <div class="ph-text">
            <h2>Manajemen Cuti</h2>
            <p>Kelola data cuti karyawan secara efisien</p>
        </div>
        <a href="{{ route('cuti.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Cuti
        </a>
    </div>

    @include('partials.flash')

    {{-- TABEL --}}
    <div class="data-card">
        <table id="cutiTable" class="table-stack">
            <thead>
                <tr>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th class="text-center no-export no-sort" style="width:13rem">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuti as $item)
                    @php $tgl = \Carbon\Carbon::parse($item->tanggal); @endphp
                    <tr>
                        <td data-label="Nomor Induk"><span class="mono">{{ $item->nomor_induk }}</span></td>
                        <td data-label="Nama"><span class="cell-main">{{ $item->pengguna->nama ?? '-' }}</span></td>
                        <td data-label="Tanggal" data-order="{{ $tgl->format('Y-m-d') }}" class="whitespace-nowrap">
                            <span class="inline-flex items-center gap-2">
                                <i class="bi bi-calendar-event" style="color:#6366f1"></i>
                                {{ $tgl->locale('id')->translatedFormat('d F Y') }}
                            </span>
                        </td>
                        <td class="td-actions text-center">
                            <div class="act-group">
                                <a href="{{ route('cuti.edit', $item->id) }}" class="act edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
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
        initDataTable('#cutiTable', { title: 'Data Cuti', order: [[2, 'desc']], emptyText: 'Belum ada data cuti' });
    });
</script>
@endpush
