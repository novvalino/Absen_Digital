@extends('layouts.app')

@section('title', 'Ubah Denda')

@section('content')
<div class="form-page">

    <div class="form-head">
        <a href="{{ route('denda.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div>
            <h2 class="text-xl font-extrabold m-0">Ubah Aturan Denda</h2>
            <p class="text-sm text-slate-500 m-0">Perbarui urutan atau nominal denda.</p>
        </div>
    </div>

    @include('partials.form-errors')

    <div class="form-card">
        <div class="profile-banner">
            <div class="avatar-lg"><i class="bi bi-cash-coin"></i></div>
            <div class="min-w-0">
                <p class="banner-name truncate">{{ $denda->jenis }}</p>
                <p class="banner-sub">Urutan {{ $denda->prioritas }}</p>
            </div>
        </div>

        @include('denda._form', [
            'action'      => route('denda.update', $denda->id),
            'method'      => 'PUT',
            'denda'       => $denda,
            'submitLabel' => 'Simpan Perubahan',
        ])
    </div>
</div>
@endsection
