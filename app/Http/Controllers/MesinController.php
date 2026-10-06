<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use App\Models\CabangGedung;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    public function index()
    {
        $mesin = Mesin::with('cabangGedung')->get();

        return view('mesin.index', compact('mesin'));
    }

    public function create()
    {
        $cabang = CabangGedung::orderBy('lokasi')->get();

        return view('mesin.create', compact('cabang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idmesin' => 'required|string|max:255|unique:mesin,idmesin',
            'id_cabang_gedung' => 'required|exists:cabang_gedung,id',
            'keterangan' => 'required|string|max:255',
        ], [
            'idmesin.unique' => 'Kode mesin sudah digunakan.',
            'idmesin.required' => 'Kode mesin wajib diisi.',
            'id_cabang_gedung.required' => 'Cabang gedung wajib dipilih.',
            'keterangan.required' => 'Keterangan wajib diisi.',
        ]);

        Mesin::create($request->only('idmesin','id_cabang_gedung','keterangan'));

        return redirect()->route('mesin.index')->with('success', 'Data mesin berhasil ditambahkan.');
    }

    public function edit($idmesin)
    {
        $mesin = Mesin::findOrFail($idmesin);
        $cabang = CabangGedung::orderBy('lokasi')->get();

        return view('mesin.edit', compact('mesin', 'cabang'));
    }

    public function update(Request $request, $idmesin)
    {
        $request->validate([
            'idmesin' => 'required|string|max:255|unique:mesin,idmesin,'.$idmesin.',idmesin',
            'id_cabang_gedung' => 'required|exists:cabang_gedung,id',
            'keterangan' => 'required|string|max:255',
        ], [
            'idmesin.unique' => 'Kode mesin sudah digunakan.',
            'idmesin.required' => 'Kode mesin wajib diisi.',
            'id_cabang_gedung.required' => 'Cabang gedung wajib dipilih.',
            'keterangan.required' => 'Keterangan wajib diisi.',
        ]);

        $mesin = Mesin::findOrFail($idmesin);
        $mesin->update($request->only('idmesin','id_cabang_gedung','keterangan'));

        return redirect()->route('mesin.index')->with('success', 'Data mesin berhasil diperbarui.');
    }
}
