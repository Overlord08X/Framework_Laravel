<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarPetController extends Controller
{
    public function index()
    {
        $pet = DB::table('pet')
            ->select(
                'pet.*',
                'pemilik.no_wa',
                'pemilik.alamat',
                'user.nama as nama_pemilik',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->join('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->join('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')
            ->join('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->get();

        return view('admin.DaftarPet.index', compact('pet'));
    }


    public function create()
    {
        $pemilik = DB::table('pemilik')
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->select('pemilik.*', 'user.nama')
            ->get();

        $rasHewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->select(
                'ras_hewan.*',
                'jenis_hewan.nama_jenis_hewan as nama_jenis'
            )
            ->get();

        return view('admin.DaftarPet.create', compact('pemilik', 'rasHewan'));
    }


    public function store(Request $request)
    {
        $data = $this->validatePet($request);

        DB::table('pet')->insert([
            'nama'           => $this->formatNama($data['nama']),
            'tanggal_lahir'  => $data['tanggal_lahir'],
            'warna_tanda'    => $data['warna_tanda'] ?? null,
            'jenis_kelamin'  => $data['jenis_kelamin'],
            'idpemilik'      => $data['idpemilik'],
            'idras_hewan'    => $data['idras_hewan'],
        ]);

        return redirect()->route('admin.DaftarPet.index')
            ->with('success', 'Data Pet berhasil disimpan.');
    }


    public function edit($id)
    {
        // Ambil data pet
        $pet = DB::table('pet')
            ->where('idpet', $id)
            ->first();

        // Ambil semua pemilik + nama user
        $Pemilik = DB::table('pemilik')
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->select('pemilik.*', 'user.nama')
            ->get();

        // Ambil ras hewan + jenis hewan
        $RasHewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
            ->get();

        return view('admin.DaftarPet.edit', compact('pet', 'Pemilik', 'RasHewan'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validatePet($request);

        DB::table('pet')->where('idpet', $id)->update([
            'nama'           => $this->formatNama($data['nama']),
            'tanggal_lahir'  => $data['tanggal_lahir'],
            'warna_tanda'    => $data['warna_tanda'] ?? null,
            'jenis_kelamin'  => $data['jenis_kelamin'],
            'idpemilik'      => $data['idpemilik'],
            'idras_hewan'    => $data['idras_hewan'],
        ]);

        return redirect()->route('admin.DaftarPet.index')
            ->with('success', 'Data Pet berhasil diperbarui.');
    }


    public function destroy($id)
    {
        DB::table('pet')->where('idpet', $id)->delete();

        return redirect()->route('admin.DaftarPet.index')
            ->with('success', 'Data Pet berhasil dihapus.');
    }


    // Helper
    protected function validatePet(Request $request)
    {
        return $request->validate([
            'nama'          => 'required|string|max:100|min:3',
            'tanggal_lahir' => 'required|date',
            'warna_tanda'   => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|in:M,F',
            'idpemilik'     => 'required|exists:pemilik,idpemilik',
            'idras_hewan'   => 'required|exists:ras_hewan,idras_hewan',
        ]);
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
