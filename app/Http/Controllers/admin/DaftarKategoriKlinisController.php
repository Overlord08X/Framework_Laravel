<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class DaftarKategoriKlinisController extends Controller
{
    public function index()
    {
        $KategoriKlinis = KategoriKlinis::all();
        return view('admin.DaftarKategoriKlinis.index', compact('KategoriKlinis'));
    }

    public function create()
    {
        return view('admin.DaftarKategoriKlinis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255',
        ]);

        KategoriKlinis::create([
            'nama_kategori_klinis' => $request->nama_kategori_klinis,
        ]);

        return redirect()->route('admin.DaftarKategoriKlinis.index')->with('success', 'Kategori Klinis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $KategoriKlinis = KategoriKlinis::findOrFail($id);
        return view('admin.DaftarKategoriKlinis.edit', compact('KategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255',
        ]);

        $KategoriKlinis = KategoriKlinis::findOrFail($id);
        $KategoriKlinis->update([
            'nama_kategori_klinis' => $request->nama_kategori_klinis,
        ]);

        return redirect()->route('admin.DaftarKategoriKlinis.index')->with('success', 'Kategori Klinis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $KategoriKlinis = KategoriKlinis::findOrFail($id);
        $KategoriKlinis->delete();

        return redirect()->route('admin.DaftarKategoriKlinis.index')->with('success', 'Kategori Klinis berhasil dihapus.');
    }
}
