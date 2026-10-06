@extends('layouts.app')

@section('title', 'Tambah Cuti')

@section('content')
<div class="form-page is-narrow">

    <div class="form-head">
        <a href="{{ route('cuti.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div>
            <h2 class="text-xl font-extrabold m-0">Tambah Cuti</h2>
            <p class="text-sm text-slate-500 m-0">Pilih karyawan dan tanggal cutinya.</p>
        </div>
    </div>

    @include('partials.form-errors')
    @include('partials.flash')

    <div class="form-card">
        <div class="profile-banner">
            <div class="avatar-lg"><i class="bi bi-calendar-plus-fill"></i></div>
            <div class="min-w-0">
                <p class="banner-name">Cuti Baru</p>
                <p class="banner-sub">Karyawan dan tanggal cuti</p>
            </div>
        </div>

        <form method="POST" action="{{ route('cuti.store') }}">
            @csrf

            <div class="form-body">

                <div class="field">
                    <label for="nomor_induk">Karyawan</label>
                    <div class="input-icon">
                        <i class="bi bi-person"></i>
                        <select id="nomor_induk" name="nomor_induk"
                            class="form-select @error('nomor_induk') is-invalid @enderror" required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach ($pengguna as $p)
                                <option value="{{ $p->nomor_induk }}" {{ (string) old('nomor_induk') === (string) $p->nomor_induk ? 'selected' : '' }}>
                                    {{ $p->nomor_induk }} - {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('nomor_induk') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="tanggal">Tanggal Cuti</label>
                    <div class="input-icon">
                        <i class="bi bi-calendar-event"></i>
                        <input type="date" id="tanggal" name="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                    </div>
                    @error('tanggal') <div class="field-error">{{ $message }}</div> @enderror
                    <div class="field-hint">Tanggal cuti tidak boleh sebelum hari ini.</div>
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('cuti.index') }}" class="btn-x btn-cancel"><i class="bi bi-x-lg"></i> Batal</a>
                <button type="submit" class="btn-x btn-submit"><i class="bi bi-check2-circle"></i> Simpan Cuti</button>
            </div>
        </form>
    </div>
</div>
@endsection
