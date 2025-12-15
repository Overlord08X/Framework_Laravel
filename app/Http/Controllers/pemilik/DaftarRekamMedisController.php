<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DaftarRekamMedisController extends Controller
{
    public function index()
    {
    $iduser = Auth::user()->iduser;

    $rekamMedis = DB::table('rekam_medis')
        ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
        ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
        ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
        ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
        ->join('user', 'role_user.iduser', '=', 'user.iduser')
        ->select(
            'rekam_medis.idrekam_medis',
            'rekam_medis.created_at',
            'rekam_medis.anamnesa',
            'rekam_medis.diagnosa',
            'pet.nama as nama_pet',
            'user.nama as nama_dokter'
        )
        ->where('pemilik.iduser', $iduser)
        ->orderBy('rekam_medis.created_at', 'desc')
        ->get();

    return view('pemilik.RekamMedis.index', compact('rekamMedis'));
    }
}
