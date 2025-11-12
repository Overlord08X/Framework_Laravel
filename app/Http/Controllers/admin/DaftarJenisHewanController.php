<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class DaftarJenisHewanController extends Controller
{
    public function index()
    {
        $JenisHewan = JenisHewan::all();
        return view('admin.DaftarJenisHewan.index', compact('JenisHewan'));
    }

    public function create()
    {
        return view('admin.DaftarJenisHewan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateJenisHewan($request);

        // Helper untuk menyimpan data
        $jenisHewan = $this->createJenisHewan($validatedData);

        return redirect()->route('admin.DaftarJenisHewan.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        return view('admin.DaftarJenisHewan.edit', compact('jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateJenisHewan($request, $id);

        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->update([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']),
        ]);

        return redirect()->route('admin.DaftarJenisHewan.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->delete();

        return redirect()->route('admin.DaftarJenisHewan.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    protected function validateJenisHewan(Request $request, $id = null)
    {
        // Data yang bersifat uniq
        $uniqueRule = $id ?
            'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan' :
            'unique:jenis_hewan,nama_jenis_hewan';

        // Validasi data input
        return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama Jenis wajib diisi.',
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis_hewan.max' => 'Nama jenis hewan tidak boleh lebih dari 255 karakter.',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createJenisHewan(array $data)
    {
        try {
            return JenisHewan::create([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data jenis hewan:' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
