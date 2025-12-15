<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JadwalTemuDokterController extends Controller
{
    public function index()
    {
    $iduser = Auth::user()->iduser;

    $jadwal = DB::table('temu_dokter')
        ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
        ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
        ->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
        ->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')
        ->select(
            'temu_dokter.idreservasi_dokter',
            'temu_dokter.no_urut',
            'temu_dokter.waktu_daftar',
            'temu_dokter.status',
            'pet.nama as nama_pet',
            'user.nama as nama_resepsionis'
        )
        ->where('pemilik.iduser', $iduser)
        ->orderBy('temu_dokter.waktu_daftar', 'desc')
        ->get();

    return view('pemilik.Jadwal.index', compact('jadwal'));
    }
}
