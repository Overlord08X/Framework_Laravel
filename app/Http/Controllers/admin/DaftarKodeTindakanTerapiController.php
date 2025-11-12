<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class DaftarKodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $KodeTindakanTerapi = KodeTindakanTerapi::all();
        return view('admin.DaftarKodeTindakanTerapi.index', compact('KodeTindakanTerapi'));
    }

    public function create()
    {
        $Kategori = Kategori::all();
        $KategoriKlinis = KategoriKlinis::all();
        return view('admin.DaftarKodeTindakanTerapi.create', compact('Kategori', 'KategoriKlinis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|max:5',
            'deskripsi_tindakan_terapi' => 'required|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        KodeTindakanTerapi::create([
            'kode' => $request->kode,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);

        return redirect()->route('admin.DaftarKodeTindakanTerapi.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $KodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $Kategori = Kategori::all();
        $KategoriKlinis = KategoriKlinis::all();

        return view('admin.DaftarKodeTindakanTerapi.edit', compact('KodeTindakanTerapi', 'Kategori', 'KategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|max:5',
            'deskripsi_tindakan_terapi' => 'required|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        $KodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);

        $KodeTindakanTerapi->update([
            'kode' => $request->kode,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);

        return redirect()->route('admin.DaftarKodeTindakanTerapi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $KodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $KodeTindakanTerapi->delete();

        return redirect()->route('admin.DaftarKodeTindakanTerapi.index')->with('success', 'Data berhasil dihapus.');
    }
}
