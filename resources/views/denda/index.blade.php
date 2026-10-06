@extends('layouts.app')

@section('title', 'Pengaturan Denda')

@section('content')
@php $rp = fn ($n) => 'Rp ' . number_format((int) $n, 0, ',', '.'); @endphp

<div class="page-wrap">

    {{-- HEADER --}}
    <div class="page-head">
        <div class="ph-icon"><i class="bi bi-cash-coin"></i></div>
        <div class="ph-text">
            <h2>Pengaturan Denda</h2>
            <p>Kelola aturan dan nominal denda</p>
        </div>
        <a href="{{ route('denda.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Denda
        </a>
    </div>

    @include('partials.flash')

    {{-- TABEL --}}
    <div class="data-card">
        <table id="dendaTable" class="table-stack">
            <thead>
                <tr>
                    <th style="width:6rem">Urutan</th>
                    <th>Jenis</th>
                    <th>Denda</th>
                    <th class="text-center no-export no-sort" style="width:13rem">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($denda as $d)
                    <tr>
                        <td data-label="Urutan" data-order="{{ $d->prioritas }}">
                            <span class="badge-soft indigo">{{ $d->prioritas }}</span>
                        </td>
                        <td data-label="Jenis"><span class="cell-main">{{ $d->jenis }}</span></td>
                        <td data-label="Denda" data-order="{{ $d->rupiah_pertama }}">
                            @if (in_array($d->prioritas, [5, 6, 7, 8]))
                                <span class="cell-main">{{ $rp($d->rupiah_pertama) }}</span>
                            @else
                                <span class="cell-main">{{ $rp($d->rupiah_pertama) }}</span>
                                <span class="cell-sub">
                                    lalu {{ $rp($d->rupiah_selanjutnya) }} / {{ $d->per_menit }} menit
                                </span>
                            @endif
                        </td>
                        <td class="td-actions text-center">
                            <div class="act-group">
                                <a href="{{ route('denda.edit', $d->id) }}" class="act edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('denda.destroy', $d->id) }}" method="POST"
                                    data-confirm="Hapus aturan denda &quot;{{ $d->jenis }}&quot;?"
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
        initDataTable('#dendaTable', { title: 'Aturan Denda', order: [[0, 'asc']], pageLength: 8, emptyText: 'Belum ada aturan denda' });
    });
</script>
@endpush
