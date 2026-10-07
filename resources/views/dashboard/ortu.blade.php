@extends('layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')
<div class="p-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Dashboard Orang Tua</h1>
        <p class="text-slate-500 mt-1">Selamat datang, {{ $user->nama ?? $user->name ?? 'Orang Tua' }}!</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <div class="text-center py-10">
            <svg class="w-16 h-16 mx-auto text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <h2 class="text-xl font-bold text-slate-700">Halaman Orang Tua</h2>
            <p class="text-slate-500 mt-2 max-w-md mx-auto">
                Ini adalah halaman dashboard khusus untuk Orang Tua. Fitur pemantauan siswa sedang dalam tahap pengembangan dan akan segera hadir.
            </p>
        </div>
    </div>
</div>
@endsection
