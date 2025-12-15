<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DaftarPetController extends Controller
{
    public function index()
    {
    $iduser = Auth::user()->iduser;

    $pets = DB::table('pet')
        ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
        ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
        ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
        ->select(
            'pet.idpet',
            'pet.nama',
            'pet.tanggal_lahir',
            'pet.jenis_kelamin',
            'pet.warna_tanda',
            'ras_hewan.nama_ras',
            'jenis_hewan.nama_jenis_hewan'
        )
        ->where('pemilik.iduser', $iduser)
        ->get();

    return view('pemilik.Pet.index', compact('pets'));
    }
}
