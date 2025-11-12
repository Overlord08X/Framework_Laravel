<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class DaftarRasHewanController extends Controller
{
    public function index()
    {
        $RasHewan = RasHewan::all();
        return view('admin.DaftarRasHewan.index', compact('RasHewan'));
    }

    public function create()
    {
        $JenisHewan = JenisHewan::all();
        return view('admin.DaftarRasHewan.create', compact('JenisHewan'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRasHewan($request);

        RasHewan::create([
            'nama_ras' => trim($validatedData['nama_ras']),
            'idjenis_hewan' => $validatedData['idjenis_hewan'],
        ]);

        return redirect()->route('admin.DaftarRasHewan.index')
            ->with('success', 'Data Ras Hewan berhasil disimpan.');
    }

    public function edit($id)
    {
        $rashewan = RasHewan::findOrFail($id);
        $JenisHewan = JenisHewan::all();
        return view('admin.DaftarRasHewan.edit', compact('rashewan', 'JenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateRasHewan($request);

        $rashewan = RasHewan::findOrFail($id);
        $rashewan->update([
            'nama_ras' => trim($validatedData['nama_ras']),
            'idjenis_hewan' => $validatedData['idjenis_hewan'],
        ]);

        return redirect()->route('admin.DaftarRasHewan.index')
            ->with('success', 'Data Ras Hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rashewan = RasHewan::findOrFail($id);
        $rashewan->delete();

        return redirect()->route('admin.DaftarRasHewan.index')
            ->with('success', 'Data Ras Hewan berhasil dihapus.');
    }

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
