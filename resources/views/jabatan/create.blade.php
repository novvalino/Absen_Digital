@extends('layouts.app')

@section('title', 'Tambah Jabatan')

@section('content')
<div class="form-page is-narrow">

    <div class="form-head">
        <a href="{{ route('jabatan.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div>
            <h2 class="text-xl font-extrabold m-0">Tambah Jabatan Baru</h2>
            <p class="text-sm text-slate-500 m-0">Tentukan nama jabatan dan hak aksesnya.</p>
        </div>
    </div>

    @include('partials.form-errors')

    <div class="form-card">
        <div class="profile-banner">
            <div class="avatar-lg"><i class="bi bi-person-badge-fill"></i></div>
            <div class="min-w-0">
                <p class="banner-name">Jabatan Baru</p>
                <p class="banner-sub">Nama jabatan dan hak akses sistem</p>
            </div>
        </div>

        @include('jabatan._form', [
            'action'       => route('jabatan.store'),
            'method'       => 'POST',
            'jabatan'      => null,
            'hakAksesList' => $hakAksesList,
            'submitLabel'  => 'Simpan Jabatan',
        ])
    </div>
</div>
@endsection
