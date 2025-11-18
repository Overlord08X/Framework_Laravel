<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarKategoriKlinisController extends Controller
{
    public function index()
    {
        $KategoriKlinis = DB::table('kategori_klinis')->get();

        return view('admin.DaftarKategoriKlinis.index', compact('KategoriKlinis'));
    }

    public function create()
    {
        return view('admin.DaftarKategoriKlinis.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateKategoriKlinis($request);

        $this->createKategoriKlinis($data);

        return redirect()->route('admin.DaftarKategoriKlinis.index')
            ->with('success', 'Kategori Klinis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $KategoriKlinis = $this->editKategoriKlinis($id);

        return view('admin.DaftarKategoriKlinis.edit', compact('KategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateKategoriKlinis($request);

        $this->updateKategoriKlinis($id, $data);

        return redirect()->route('admin.DaftarKategoriKlinis.index')->with('success', 'Kategori Klinis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->deleteKategoriKlinis($id);

        return redirect()->route('admin.DaftarKategoriKlinis.index')->with('success', 'Kategori Klinis berhasil dihapus.');
    }


    // Helper
    protected function validateKategoriKlinis(Request $request)
    {
        return $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255',
        ]);
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));  // title case
    }

    protected function createKategoriKlinis(array $data)
    {
        return DB::table('kategori_klinis')->insert([
            'nama_kategori_klinis' => $this->formatNama($data['nama_kategori_klinis']),
        ]);
    }

    protected function editKategoriKlinis($id)
    {
        return DB::table('kategori_klinis')->where('idkategori_klinis', $id)->first();
    }

    protected function updateKategoriKlinis($id, array $data)
    {
        return DB::table('kategori_klinis')
            ->where('idkategori_klinis', $id)
            ->update([
                'nama_kategori_klinis' => $this->formatNama($data['nama_kategori_klinis']),
            ]);
    }

    protected function deleteKategoriKlinis($id)
    {
        return DB::table('kategori_klinis')
            ->where('idkategori_klinis', $id)
            ->delete();
    }
}
