<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    /**
     * ===============================
     * HALAMAN INDEX REKAM MEDIS
     * ===============================
     */
    public function index()
    {
        // ===============================
        // DAFTAR TEMU DOKTER HARI INI
        // ===============================
        $daftarHariIni = DB::table('temu_dokter as rd')
            ->join('pet', 'rd.idpet', '=', 'pet.idpet')
            ->join('pemilik as pm', 'pet.idpemilik', '=', 'pm.idpemilik')
            ->join('user', 'pm.iduser', '=', 'user.iduser')
            ->whereDate('rd.waktu_daftar', now()->toDateString())
            ->select(
                'rd.idreservasi_dokter',
                'pet.nama as nama_pet',
                'user.nama as nama_pemilik',
                'rd.no_urut'
            )
            ->orderBy('rd.no_urut', 'asc')
            ->get();

        // ===============================
        // SEMUA REKAM MEDIS
        // ===============================
        $allRekamMedis = DB::table('rekam_medis as rm')
            ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->join('user as u', 'rm.dokter_pemeriksa', '=', 'u.iduser')
            ->select(
                'rm.idrekam_medis',
                'rm.created_at',
                'rm.anamnesa',
                'rm.diagnosa',
                'u.nama as dokter_pemeriksa',
                'rm.idreservasi_dokter'
            )
            ->orderByDesc('rm.created_at')
            ->get();

        return view('perawat.RekamMedis.index', compact(
            'daftarHariIni',
            'allRekamMedis'
        ));
    }

    /**
     * ===============================
     * SIMPAN REKAM MEDIS (INI YANG HILANG)
     * ===============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required',
            'anamnesa'           => 'required|string',
            'diagnosa'           => 'required|string',
            'tindakan'           => 'required|string',
        ]);

        $iduser = Auth::user()->iduser;

        DB::table('rekam_medis')->insert([
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'anamnesa'           => $request->anamnesa,
            'diagnosa'           => $request->diagnosa,
            'tindakan'           => $request->tindakan,
            'dokter_pemeriksa'   => $iduser,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        return redirect()
            ->route('perawat.RekamMedis.index')
            ->with('success', 'Rekam medis berhasil disimpan');
    }

    /**
     * ===============================
     * DETAIL REKAM MEDIS
     * ===============================
     */
    public function show($id)
    {
        $rekamMedis = DB::table('rekam_medis as rm')
            ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->join('user as u', 'rm.dokter_pemeriksa', '=', 'u.iduser')
            ->where('rm.idrekam_medis', $id)
            ->select(
                'rm.*',
                'u.nama as dokter_pemeriksa'
            )
            ->first();

        abort_if(!$rekamMedis, 404);

        return view('perawat.RekamMedis.show', compact('rekamMedis'));
    }
}
