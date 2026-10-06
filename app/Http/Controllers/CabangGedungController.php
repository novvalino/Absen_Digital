<?php

namespace App\Http\Controllers;

use App\Models\CabangGedung;
use Illuminate\Http\Request;

class CabangGedungController extends Controller
{
    public function index()
    {
        $data = CabangGedung::orderBy('lokasi')->get();
        return view('cabang_gedung.index', compact('data'));
    }

    public function create()
    {
        return view('cabang_gedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'istirahat_mulai' => 'required',
            'istirahat_selesai' => 'required',
            'hari_libur' => 'nullable|array',
            'zona_waktu' => 'required',
        ]);

        CabangGedung::create([
            'lokasi' => $request->lokasi,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'istirahat_mulai' => $request->istirahat_mulai,
            'istirahat_selesai' => $request->istirahat_selesai,
            // kolom hari_libur NOT NULL -> string kosong bila tidak ada hari libur
            'hari_libur' => implode(',', $request->hari_libur ?? []),
            'zona_waktu' => $request->zona_waktu,
            'aktif' => 1,
        ]);

        return redirect()->route('cabang-gedung.index')
            ->with('success', 'Cabang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $cabang = CabangGedung::findOrFail($id);
        return view('cabang_gedung.edit', compact('cabang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lokasi' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'istirahat_mulai' => 'required',
            'istirahat_selesai' => 'required',
            'hari_libur' => 'nullable|array',
            'zona_waktu' => 'required',
        ]);

        $cabang = CabangGedung::findOrFail($id);

        $cabang->update([
            'lokasi' => $request->lokasi,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'istirahat_mulai' => $request->istirahat_mulai,
            'istirahat_selesai' => $request->istirahat_selesai,
            // kolom hari_libur NOT NULL -> string kosong bila tidak ada hari libur
            'hari_libur' => implode(',', $request->hari_libur ?? []),
            'zona_waktu' => $request->zona_waktu,
        ]);

        return redirect()->route('cabang-gedung.index')
            ->with('success', 'Cabang berhasil diupdate');
    }

    public function destroy($id)
    {
        $cabang = CabangGedung::findOrFail($id);

        // toggle aktif / nonaktif
        $cabang->aktif = $cabang->aktif == 1 ? 0 : 1;
        $cabang->save();

        return back()->with('success', 'Status cabang diperbarui');
    }
}
