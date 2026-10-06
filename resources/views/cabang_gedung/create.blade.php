@extends('layouts.app')

@section('title', 'Tambah Cabang')

@section('content')
<div class="form-page">

    <div class="form-head">
        <a href="{{ route('cabang-gedung.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div>
            <h2 class="text-xl font-extrabold m-0">Tambah Cabang Baru</h2>
            <p class="text-sm text-slate-500 m-0">Atur lokasi, jam kerja, dan hari libur cabang.</p>
        </div>
    </div>

    @include('partials.form-errors')

    <div class="form-card">
        <div class="profile-banner">
            <div class="avatar-lg"><i class="bi bi-buildings-fill"></i></div>
            <div class="min-w-0">
                <p class="banner-name">Cabang Baru</p>
                <p class="banner-sub">Lokasi, jam operasional, dan zona waktu</p>
            </div>
        </div>

        @include('cabang_gedung._form', [
            'action'      => route('cabang-gedung.store'),
            'method'      => 'POST',
            'cabang'      => null,
            'submitLabel' => 'Simpan Cabang',
        ])
    </div>
</div>
@endsection
