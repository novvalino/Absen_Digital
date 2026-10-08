@extends('layouts.app')

@section('title', 'Ajukan Izin & Sakit')

@section('content')
<div class="container-fluid px-4 py-6 max-w-3xl mx-auto">
    
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('siswa.izin.index') }}" class="w-10 h-10 rounded-full bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-600 hover:text-blue-600 hover:border-blue-200 transition">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Form Pengajuan Izin</h1>
            <p class="text-gray-600">Isi detail ketidakhadiran Anda di bawah ini</p>
        </div>
    </div>

    @include('partials.flash')
    @include('partials.form-errors')

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
        <form action="{{ route('siswa.izin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Tanggal Mulai --}}
                <div>
                    <label for="tanggal_mulai" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Mulai <span class="text-rose-500">*</span></label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" 
                        class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white"
                        value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required>
                </div>

                {{-- Tanggal Selesai --}}
                <div>
                    <label for="tanggal_selesai" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Selesai <span class="text-rose-500">*</span></label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" 
                        class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white"
                        value="{{ old('tanggal_selesai', date('Y-m-d')) }}" required>
                </div>
            </div>

            {{-- Kategori --}}
            <div class="mb-6">
                <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">Kategori / Jenis <span class="text-rose-500">*</span></label>
                <select id="kategori" name="kategori" class="w-full h-12 px-4 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white" required>
                    <option value="" disabled selected>Pilih Kategori...</option>
                    <option value="Izin" {{ old('kategori') == 'Izin' ? 'selected' : '' }}>Izin (Keperluan Keluarga, dll)</option>
                    <option value="Sakit" {{ old('kategori') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                </select>
            </div>

            {{-- Alasan --}}
            <div class="mb-6">
                <label for="alasan" class="block text-sm font-semibold text-slate-700 mb-2">Alasan / Keterangan <span class="text-rose-500">*</span></label>
                <textarea id="alasan" name="alasan" rows="3" 
                    class="w-full p-4 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white" 
                    placeholder="Tuliskan alasan lengkap Anda di sini..." required>{{ old('alasan') }}</textarea>
            </div>

            {{-- Bukti Dokumen --}}
            <div class="mb-6">
                <label for="bukti_file" class="block text-sm font-semibold text-slate-700 mb-2">Bukti Dokumen (Surat Dokter / Orang Tua)</label>
                <input type="file" id="bukti_file" name="bukti_file" accept=".pdf,.jpg,.jpeg,.png"
                    class="w-full p-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm bg-slate-50 focus:bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="mt-2 text-xs text-slate-500">Opsional, namun sangat disarankan untuk kategori 'Sakit'. Format: PDF, JPG, PNG (Maks 2MB).</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-4 mt-8 pt-6 border-t border-slate-100">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 hover:shadow-md transition flex justify-center items-center gap-2">
                    <i class="bi bi-send-fill"></i> Ajukan Sekarang
                </button>
                <a href="{{ route('siswa.izin.index') }}" class="w-full sm:w-auto px-8 py-3 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
