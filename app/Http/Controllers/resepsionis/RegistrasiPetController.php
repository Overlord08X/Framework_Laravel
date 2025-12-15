<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrasiPetController extends Controller
{
    /**
     * HALAMAN DEFAULT REGISTRASI PET
     */
    public function index()
    {
        return $this->create();
    }

    /**
     * FORM REGISTRASI PET
     */
    public function create()
    {
        $pemilikList = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.idpemilik', 'user.nama')
            ->orderBy('user.nama')
            ->get();

        $rasHewanList = DB::table('ras_hewan as r')
            ->join('jenis_hewan as j', 'r.idjenis_hewan', '=', 'j.idjenis_hewan')
            ->select(
                'r.idras_hewan',
                'r.nama_ras',
                'j.nama_jenis_hewan'
            )
            ->orderBy('j.nama_jenis_hewan')
            ->orderBy('r.nama_ras')
            ->get();

        return view('resepsionis.RegistrasiPet.index', compact('pemilikList', 'rasHewanList'));
    }

    /**
     * SIMPAN DATA PET
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'warna_tanda'    => 'nullable|string|max:255',
            'jenis_kelamin'  => 'required|in:M,F',
            'idpemilik'      => 'required|integer|exists:pemilik,idpemilik',
            'idras_hewan'    => 'required|integer|exists:ras_hewan,idras_hewan',
        ]);

        DB::beginTransaction();

        try {
            DB::table('pet')->insert([
                'nama'          => $validated['nama'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'warna_tanda'   => $validated['warna_tanda'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'idpemilik'     => $validated['idpemilik'],
                'idras_hewan'   => $validated['idras_hewan'],
            ]);

            DB::commit();

            return redirect()
                ->route('resepsionis.dashboard-resepsionis')
                ->with('success', 'Registrasi pet berhasil');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()
                ->withErrors(['error' => 'Gagal menyimpan data pet'])
                ->withInput();
        }
    }
}
