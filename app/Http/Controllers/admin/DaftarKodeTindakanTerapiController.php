<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarKodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $KodeTindakanTerapi = DB::table('kode_tindakan_terapi')->get();

        return view('admin.DaftarKodeTindakanTerapi.index', compact('KodeTindakanTerapi'));
    }

    public function create()
    {
        $Kategori = DB::table('kategori')->get();
        $KategoriKlinis = DB::table('kategori_klinis')->get();

        return view('admin.DaftarKodeTindakanTerapi.create', compact('Kategori', 'KategoriKlinis'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $this->createData($data);

        return redirect()->route('admin.DaftarKodeTindakanTerapi.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $KodeTindakanTerapi = $this->findData($id);

        $Kategori = DB::table('kategori')->get();
        $KategoriKlinis = DB::table('kategori_klinis')->get();

        return view('admin.DaftarKodeTindakanTerapi.edit', compact('KodeTindakanTerapi', 'Kategori', 'KategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateData($request);

        $this->updateData($id, $data);

        return redirect()->route('admin.DaftarKodeTindakanTerapi.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->deleteData($id);

        return redirect()->route('admin.DaftarKodeTindakanTerapi.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    
    // Helper
    protected function validateData(Request $request)
    {
        return $request->validate([
            'kode' => 'required|max:5',
            'deskripsi_tindakan_terapi' => 'required|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);
    }

    protected function formatText($text)
    {
        return trim(ucwords(strtolower($text)));
    }

    protected function createData(array $data)
    {
        return DB::table('kode_tindakan_terapi')->insert([
            'kode' => $this->formatText($data['kode']),
            'deskripsi_tindakan_terapi' => $data['deskripsi_tindakan_terapi'],
            'idkategori' => $data['idkategori'],
            'idkategori_klinis' => $data['idkategori_klinis'],
        ]);
    }

    protected function findData($id)
    {
        return DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->first();
    }

    protected function updateData($id, array $data)
    {
        return DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->update([
                'kode' => $this->formatText($data['kode']),
                'deskripsi_tindakan_terapi' => $data['deskripsi_tindakan_terapi'],
                'idkategori' => $data['idkategori'],
                'idkategori_klinis' => $data['idkategori_klinis'],
            ]);
    }

    protected function deleteData($id)
    {
        return DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->delete();
    }
}
