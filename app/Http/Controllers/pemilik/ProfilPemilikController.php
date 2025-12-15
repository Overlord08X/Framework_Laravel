<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfilPemilikController extends Controller
{
    public function index()
    {
        $iduser = Auth::user()->iduser;

        $profil = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select(
                'pemilik.idpemilik',
                'user.nama',
                'user.email',
                'pemilik.no_wa',
                'pemilik.alamat'
            )
            ->where('pemilik.iduser', $iduser)
            ->first();

        return view('pemilik.Profil.index', compact('profil'));
    }
}
