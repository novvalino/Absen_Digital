@extends('layouts.app')

@section('title', 'Ubah Cabang')

@section('content')
<div class="form-page">

    <div class="form-head">
        <a href="{{ route('cabang-gedung.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div>
            <h2 class="text-xl font-extrabold m-0">Ubah Data Cabang</h2>
            <p class="text-sm text-slate-500 m-0">Perbarui informasi cabang di bawah ini.</p>
        </div>
    </div>

    @include('partials.form-errors')

    <div class="form-card">
        <div class="profile-banner">
            <div class="avatar-lg"><i class="bi bi-buildings-fill"></i></div>
            <div class="min-w-0">
                <p class="banner-name truncate">{{ $cabang->lokasi }}</p>
                <p class="banner-sub">
                    <span class="badge-soft dot {{ $cabang->aktif ? 'green' : 'red' }}" style="background:rgba(255,255,255,.2);color:#fff">
                        {{ $cabang->aktif ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </p>
            </div>
        </div>

        @include('cabang_gedung._form', [
            'action'      => route('cabang-gedung.update', $cabang->id),
            'method'      => 'PUT',
            'cabang'      => $cabang,
            'submitLabel' => 'Simpan Perubahan',
        ])
    </div>
</div>
@endsection
