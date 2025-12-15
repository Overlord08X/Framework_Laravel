<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfilPerawatController extends Controller
{
    public function index()
    {
        $iduser = Auth::user()->iduser;

        $profil = DB::table('perawat')
            ->join('user', 'perawat.id_user', '=', 'user.iduser')
            ->select(
                'perawat.id_perawat',
                'user.nama',
                'user.email',
                'perawat.no_hp',
                'perawat.alamat',
                'perawat.pendidikan',
                'perawat.jenis_kelamin'
            )
            ->where('perawat.id_user', $iduser)
            ->first();

        return view('perawat.Profil.index', compact('profil'));
    }
}
