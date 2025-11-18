<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarJenisHewanController extends Controller
{
    public function index()
    {
        // Eloquent
        // $JenisHewan = JenisHewan::all();
        // return view('admin.DaftarJenisHewan.index', compact('JenisHewan'));

        // Query Builder
        $JenisHewan = DB::table('jenis_hewan')
            ->select('idjenis_hewan', 'nama_jenis_hewan')
            ->get();

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
        // $jenisHewan = $this->createJenisHewan($validatedData);

        DB::table('jenis_hewan')->insert([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']),
        ]);

        return redirect()->route('admin.DaftarJenisHewan.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        // Eloquent
        // $jenisHewan = JenisHewan::findOrFail($id);

        $JenisHewan = DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->first();

        return view('admin.DaftarJenisHewan.edit', compact('JenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateJenisHewan($request, $id);

        // Eloquent
        // $jenisHewan = JenisHewan::findOrFail($id);
        // $jenisHewan->update([
        //     'nama_jenis_hewan' => $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']),
        // ]);

        DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->update([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']),
            ]);

        return redirect()->route('admin.DaftarJenisHewan.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Eloquent
        // $jenisHewan = JenisHewan::findOrFail($id);
        // $jenisHewan->delete();

        DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->delete();

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
            // Eloquent
            // return JenisHewan::create([
            //     'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            // ]);

            // Query Builder
            $jenisHewan = DB::table('jenis_hewan')->insert([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);

            return $jenisHewan;
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
