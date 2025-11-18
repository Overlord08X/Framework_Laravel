<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class DaftarRasHewanController extends Controller
{
    public function index()
    {
        $RasHewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
            ->orderBy('ras_hewan.idras_hewan', 'DESC')
            ->get();

        return view('admin.DaftarRasHewan.index', compact('RasHewan'));
    }

    public function create()
    {
        $JenisHewan = DB::table('jenis_hewan')
            ->orderBy('nama_jenis_hewan')
            ->get();

        return view('admin.DaftarRasHewan.create', compact('JenisHewan'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRasHewan($request);

        DB::table('ras_hewan')->insert([
            'nama_ras'      => trim($validated['nama_ras']),
            'idjenis_hewan' => $validated['idjenis_hewan'],
        ]);

        return redirect()->route('admin.DaftarRasHewan.index')
            ->with('success', 'Data Ras Hewan berhasil disimpan.');
    }

    public function edit($id)
    {
        $rashewan = DB::table('ras_hewan')->where('idras_hewan', $id)->first();

        if (!$rashewan) {
            abort(404);
        }

        $JenisHewan = DB::table('jenis_hewan')
            ->orderBy('nama_jenis_hewan')
            ->get();

        return view('admin.DaftarRasHewan.edit', compact('rashewan', 'JenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRasHewan($request);

        DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->update([
                'nama_ras'      => trim($validated['nama_ras']),
                'idjenis_hewan' => $validated['idjenis_hewan'],
            ]);

        return redirect()->route('admin.DaftarRasHewan.index')
            ->with('success', 'Data Ras Hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('ras_hewan')->where('idras_hewan', $id)->delete();

        return redirect()->route('admin.DaftarRasHewan.index')
            ->with('success', 'Data Ras Hewan berhasil dihapus.');
    }


    // Helper
    protected function validateRasHewan(Request $request)
    {
        return $request->validate([
            'nama_ras' => 'required|string|max:100|min:2',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ], [
            'nama_ras.required' => 'Nama Ras wajib diisi.',
            'nama_ras.string' => 'Nama Ras harus berupa teks.',
            'nama_ras.max' => 'Nama Ras maksimal 100 karakter.',
            'nama_ras.min' => 'Nama Ras minimal 2 karakter.',
            'idjenis_hewan.required' => 'Jenis Hewan wajib dipilih.',
            'idjenis_hewan.exists' => 'Jenis Hewan tidak valid.',
        ]);
    }
}
