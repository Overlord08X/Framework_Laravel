<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
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
}
