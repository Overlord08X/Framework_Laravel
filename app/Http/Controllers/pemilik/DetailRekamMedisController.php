<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailRekamMedisController extends Controller
{
    public function detail($id)
    {
    $rekamMedis = DB::table('rekam_medis')
        ->where('idrekam_medis', $id)
        ->first();

    $detail = DB::table('detail_rekam_medis')
        ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
        ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
        ->select(
            'kode_tindakan_terapi.kode',
            'kode_tindakan_terapi.deskripsi_tindakan_terapi',
            'kategori_klinis.nama_kategori_klinis',
            'detail_rekam_medis.detail'
        )
        ->where('detail_rekam_medis.idrekam_medis', $id)
        ->get();

    return view('pemilik.RekamMedis.detail', compact('rekamMedis', 'detail'));
    }
}
