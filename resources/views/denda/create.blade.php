@extends('layouts.app')

@section('title', 'Tambah Denda')

@section('content')
<div class="form-page">

    <div class="form-head">
        <a href="{{ route('denda.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div>
            <h2 class="text-xl font-extrabold m-0">Tambah Aturan Denda</h2>
            <p class="text-sm text-slate-500 m-0">Buat kategori aturan denda baru untuk sistem absensi.</p>
        </div>
    </div>

    @include('partials.form-errors')

    <div class="form-card">
        <div class="profile-banner">
            <div class="avatar-lg"><i class="bi bi-cash-coin"></i></div>
            <div class="min-w-0">
                <p class="banner-name">Denda Baru</p>
                <p class="banner-sub">Jenis, urutan, dan nominal denda</p>
            </div>
        </div>

        @include('denda._form', [
            'action'      => route('denda.store'),
            'method'      => 'POST',
            'denda'       => null,
            'submitLabel' => 'Simpan Denda',
        ])
    </div>
</div>
@endsection
