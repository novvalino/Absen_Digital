@extends('layouts.app')

@section('title', 'Ubah Jabatan')

@section('content')
<div class="form-page is-narrow">

    <div class="form-head">
        <a href="{{ route('jabatan.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div>
            <h2 class="text-xl font-extrabold m-0">Ubah Jabatan / Status</h2>
            <p class="text-sm text-slate-500 m-0">Perbarui nama jabatan atau hak aksesnya.</p>
        </div>
    </div>

    @include('partials.form-errors')

    <div class="form-card">
        <div class="profile-banner">
            <div class="avatar-lg"><i class="bi bi-person-badge-fill"></i></div>
            <div class="min-w-0">
                <p class="banner-name truncate">{{ $jabatan->jabatan_status }}</p>
                <p class="banner-sub"><i class="bi bi-shield-lock"></i> {{ $jabatan->hakAkses->hak ?? 'N/A' }}</p>
            </div>
        </div>

        @include('jabatan._form', [
            'action'       => route('jabatan.update', $jabatan->id),
            'method'       => 'PUT',
            'jabatan'      => $jabatan,
            'hakAksesList' => $hakAksesList,
            'submitLabel'  => 'Simpan Perubahan',
        ])
    </div>
</div>
@endsection
