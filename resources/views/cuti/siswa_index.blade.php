@extends('layouts.app')

@section('title', 'Riwayat Izin dan Sakit')

@section('content')
<div class="container-fluid px-4 py-6 max-w-7xl mx-auto">
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Riwayat Izin & Sakit</h1>
            <p class="text-slate-500 mt-2 font-medium">Daftar pengajuan izin dan sakit yang telah Anda buat.</p>
        </div>
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-white text-slate-700 border border-slate-200 rounded-xl font-bold hover:bg-slate-50 hover:text-slate-900 transition-all shadow-sm">
                <i class="bi bi-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>
            <a href="{{ route('siswa.izin.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-all shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                <i class="bi bi-plus-lg mr-2 text-sm"></i> Ajukan Izin
            </a>
        </div>
    </div>

    @include('partials.flash')

    <div class="overflow-x-auto rounded-2xl border border-slate-100 shadow-sm bg-white">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-600">
                <tr>
                    <th class="px-6 py-4 font-bold whitespace-nowrap">No</th>
                    <th class="px-6 py-4 font-bold whitespace-nowrap">Tanggal Pengajuan</th>
                    <th class="px-6 py-4 font-bold whitespace-nowrap">Rentang Tanggal</th>
                    <th class="px-6 py-4 font-bold whitespace-nowrap">Kategori</th>
                    <th class="px-6 py-4 font-bold min-w-[200px]">Alasan / Keterangan</th>
                    <th class="px-6 py-4 font-bold whitespace-nowrap text-center">Bukti Dokumen</th>
                    <th class="px-6 py-4 font-bold whitespace-nowrap text-center">Status Verifikasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                @forelse ($cuti as $index => $item)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 font-semibold">{{ $cuti->firstItem() + $index }}</td>
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->tanggal_mulai && $item->tanggal_selesai)
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->translatedFormat('d M Y') }} 
                                <span class="text-slate-400 mx-1">s/d</span> 
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->translatedFormat('d M Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('d M Y') }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(strtolower($item->kategori) == 'sakit')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-lg text-xs font-bold uppercase tracking-wider">
                                    <i class="bi bi-heart-pulse-fill"></i> Sakit
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-sky-50 text-sky-700 border border-sky-200 rounded-lg text-xs font-bold uppercase tracking-wider">
                                    <i class="bi bi-file-text-fill"></i> Izin
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm line-clamp-2" title="{{ $item->alasan }}">
                                {{ $item->alasan ?? '-' }}
                            </p>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if(!empty($item->bukti_file))
                                <a href="{{ asset('storage/' . $item->bukti_file) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 hover:text-slate-900 rounded-lg text-xs font-semibold transition-colors">
                                    <i class="bi bi-paperclip text-sm"></i> Lihat Berkas
                                </a>
                            @else
                                <span class="text-slate-400 font-bold">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @php
                                $status = $item->status_persetujuan ?? 'Pending';
                            @endphp
                            
                            @if($status == 'Disetujui')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-bold uppercase tracking-wider">
                                    <i class="bi bi-check-circle-fill"></i> Disetujui
                                </span>
                            @elseif($status == 'Ditolak')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-700 border border-rose-200 rounded-lg text-xs font-bold uppercase tracking-wider">
                                    <i class="bi bi-x-circle-fill"></i> Ditolak
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-200 rounded-lg text-xs font-bold uppercase tracking-wider">
                                    <i class="bi bi-clock-fill"></i> Menunggu
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-2">
                                    <i class="bi bi-file-earmark-x text-3xl text-slate-300"></i>
                                </div>
                                <p class="text-slate-500 font-medium">Belum ada riwayat pengajuan izin atau sakit.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($cuti->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $cuti->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
