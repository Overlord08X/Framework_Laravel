<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfilDokterController extends Controller
{
    public function index()
    {
        $iduser = Auth::user()->iduser;

        $profil = DB::table('dokter')
            ->join('user', 'dokter.id_user', '=', 'user.iduser')
            ->select(
                'dokter.id_dokter',
                'user.nama',
                'user.email',
                'dokter.no_hp',
                'dokter.alamat',
                'dokter.bidang_dokter',
                'dokter.jenis_kelamin'
            )
            ->where('dokter.id_user', $iduser)
            ->first();

        return view('dokter.Profil.index', compact('profil'));
    }
}
