<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarKategoriController extends Controller
{
    public function index()
    {
        // Eloquent
        // $Kategori = Kategori::all();
        // return view('admin.DaftarKategori.index', compact('Kategori'));

        // Query Builder
        $Kategori = DB::table('kategori')
            ->select('idkategori', 'nama_kategori')
            ->get();

        return view('admin.DaftarKategori.index', compact('Kategori'));
    }

    public function create()
    {
        return view('admin.DaftarKategori.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateKategori($request);

        // Eloquent
        // Kategori::create([
        //     'nama_kategori' => $request->nama_kategori,
        // ]);

        $this->createKategori($data);

        return redirect()->route('admin.DaftarKategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Eloquent
        // $kategori = Kategori::findOrFail($id);

        $kategori = $this->editKategori($id);

        return view('admin.DaftarKategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateKategori($request);

        // Eloquent
        // $kategori = Kategori::findOrFail($id);
        // $kategori->update([
        //     'nama_kategori' => $request->nama_kategori,
        // ]);

        $this->updateKategori($id, $data);

        return redirect()->route('admin.DaftarKategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Eloquent
        // $kategori = Kategori::findOrFail($id);
        // $kategori->delete();

        $this->deleteKategori($id);

        return redirect()->route('admin.DaftarKategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    // Helper
    protected function validateKategori(Request $request)
    {
        return $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));  // title case
    }

    protected function createKategori(array $data)
    {
        return DB::table('kategori')->insert([
            'nama_kategori' => $this->formatNama($data['nama_kategori']),
        ]);
    }

    protected function editKategori($id)
    {
        return DB::table('kategori')->where('idkategori', $id)->first();
    }

    protected function updateKategori($id, array $data)
    {
        return DB::table('kategori')
            ->where('idkategori', $id)
            ->update([
                'nama_kategori' => $this->formatNama($data['nama_kategori']),
            ]);
    }

    protected function deleteKategori($id)
    {
        return DB::table('kategori')
            ->where('idkategori', $id)
            ->delete();
    }
}
