@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-6">
        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Rekap Absensi
                <span class="text-blue-600">{{ $pengguna->nama }}</span>
            </h1>
            <p class="text-gray-600 mt-2">
                Nomor Induk: {{ $pengguna->nomor_induk }} |
                Cabang: {{ $cabang->lokasi ?? '-' }}
            </p>
        </div>

        {{-- Ringkasan Kehadiran Bulanan (4 Metrik Mini Card Sejajar) --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
            {{-- Card 1: Hadir --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm hover:shadow-md transition-all hover:scale-[1.02] cursor-default">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0 border border-emerald-100">
                        <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                    </div>
                    <span class="bg-emerald-50 border border-emerald-200 text-emerald-600 text-[10px] sm:text-xs font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">Total Hadir</span>
                </div>
                <div class="text-3xl font-extrabold text-slate-800">{{ $ringkasan['hadir'] }} <span class="text-sm font-semibold text-slate-500">Hari</span></div>
            </div>

            {{-- Card 2: Terlambat --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm hover:shadow-md transition-all hover:scale-[1.02] cursor-default">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center shrink-0 border border-amber-100">
                        <i class="fas fa-clock text-amber-500 text-xl"></i>
                    </div>
                    <span class="bg-amber-50 border border-amber-200 text-amber-600 text-[10px] sm:text-xs font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">Terlambat</span>
                </div>
                <div class="text-3xl font-extrabold text-slate-800">{{ $ringkasan['terlambat'] }} <span class="text-sm font-semibold text-slate-500">Kali</span></div>
            </div>

            {{-- Card 3: Izin / Sakit --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm hover:shadow-md transition-all hover:scale-[1.02] cursor-default">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center shrink-0 border border-sky-100">
                        <i class="fas fa-file-medical text-sky-500 text-xl"></i>
                    </div>
                    <span class="bg-sky-50 border border-sky-200 text-sky-600 text-[10px] sm:text-xs font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">Izin / Sakit</span>
                </div>
                <div class="text-3xl font-extrabold text-slate-800">{{ $ringkasan['izinSakit'] }} <span class="text-sm font-semibold text-slate-500">Hari</span></div>
            </div>

            {{-- Card 4: Alpa --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm hover:shadow-md transition-all hover:scale-[1.02] cursor-default">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center shrink-0 border border-rose-100">
                        <i class="fas fa-times-circle text-rose-500 text-xl"></i>
                    </div>
                    <span class="bg-rose-50 border border-rose-200 text-rose-600 text-[10px] sm:text-xs font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">Alpa</span>
                </div>
                <div class="text-3xl font-extrabold text-slate-800">{{ $ringkasan['alpa'] }} <span class="text-sm font-semibold text-slate-500">Hari</span></div>
            </div>
        </div>

        {{-- FILTER FORM --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 mb-8">
            <form method="GET" action="{{ route('absensi.pengguna', $pengguna->nomor_induk) }}">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 items-end">
                    {{-- Tanggal Awal --}}
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            Tanggal Awal
                        </label>
                        <input type="date" name="awal" value="{{ $firstDay }}"
                            class="w-full h-12 rounded-lg border border-gray-300 px-4 focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- Tanggal Akhir --}}
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            Tanggal Akhir
                        </label>
                        <input type="date" name="akhir" value="{{ $lastDay }}"
                            class="w-full h-12 rounded-lg border border-gray-300 px-4 focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full h-12 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                            Tampilkan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- TABLE ABSENSI --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden mb-12 p-4 sm:p-6">
            <div class="overflow-x-auto w-full -mx-4 sm:mx-0 px-4 sm:px-0">
                <table id="absensiTable" class="min-w-full text-xs sm:text-sm border-collapse">
                    <thead class="bg-gray-800 text-gray-100">
                        <tr>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 border border-gray-700 whitespace-nowrap text-center">No</th>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 border border-gray-700 whitespace-nowrap">Tanggal</th>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 border border-gray-700 whitespace-nowrap text-center">Jam Masuk</th>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 border border-gray-700 whitespace-nowrap text-center">Jam Pulang</th>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 border border-gray-700 whitespace-nowrap text-center">Status</th>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 border border-gray-700 whitespace-nowrap">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse($groupedAbsensi as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 sm:px-6 sm:py-4 border whitespace-nowrap text-center font-medium">
                                    {{ $no++ }}
                                </td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4 border whitespace-nowrap font-medium text-slate-800">
                                    {{ \Carbon\Carbon::parse($item['tanggal'])->locale('id')->translatedFormat('l, d M Y') }}
                                </td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4 border whitespace-nowrap text-center font-bold {{ $item['masuk'] ? 'text-emerald-600' : 'text-slate-400' }}">
                                    {{ $item['masuk'] ?? '-' }}
                                </td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4 border whitespace-nowrap text-center font-bold {{ $item['pulang'] ? 'text-blue-600' : 'text-slate-400' }}">
                                    {{ $item['pulang'] ?? '-' }}
                                </td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4 border text-center whitespace-nowrap">
                                    @if ($item['status'] === 'Hadir')
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 font-bold text-[11px] uppercase tracking-wider">
                                            Hadir
                                        </span>
                                    @elseif($item['status'] === 'Terlambat')
                                        <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 font-bold text-[11px] uppercase tracking-wider">
                                            Terlambat
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-bold text-[11px] uppercase tracking-wider">
                                            {{ $item['status'] }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4 border whitespace-nowrap text-slate-600">
                                    {{ $item['keterangan'] ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-500">
                                    Tidak ada data absensi pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @push('styles')
        <style>
            .dataTables_wrapper {
                padding: 0;
            }

            .dataTables_filter,
            .dt-buttons {
                margin-bottom: 1rem;
            }

            .dataTables_info,
            .dataTables_paginate {
                margin-top: 1rem;
            }

            table.dataTable {
                margin-top: 0.75rem !important;
                margin-bottom: 0.75rem !important;
            }
            
            @media (max-width: 640px) {
                .dt-buttons {
                    display: flex !important;
                    flex-wrap: wrap !important;
                    gap: 0.5rem;
                    width: 100%;
                    justify-content: center;
                }
                .dt-buttons .dt-button {
                    flex: 1 1 auto;
                    margin: 0 !important;
                }
                .dataTables_filter {
                    width: 100%;
                    margin-top: 0.5rem;
                }
                .dataTables_filter label {
                    width: 100%;
                    display: flex;
                    flex-direction: column;
                    text-align: left;
                }
                .dataTables_filter input {
                    width: 100% !important;
                    margin-left: 0 !important;
                    margin-top: 0.5rem;
                    padding: 0.5rem;
                    border-radius: 0.5rem;
                    border: 1px solid #e5e7eb;
                }
            }
        </style>
    @endpush

    @push('scripts')
<script>
$(document).ready(function() {
    $('#absensiTable').DataTable({
        responsive: true,
        pageLength: 10,
        order: [], // Disable initial sort so it respects the backend grouped order
        lengthChange: false,

        dom: "<'flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4'Bf>" +
             "<'overflow-x-auto w-full -mx-4 sm:mx-0 px-4 sm:px-0't>" +
             "<'flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-4'ip>",

        buttons: [
            { extend: 'excel', title: 'Rekap Absen' },
            { extend: 'pdf', title: 'Rekap Absen' }
        ],

        language: {
            search: "Cari:",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "‹",
                next: "›"
            },
            zeroRecords: "Data tidak ditemukan"
        }
    });
});
</script>
    @endpush
@endsection
