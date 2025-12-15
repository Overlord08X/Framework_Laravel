<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
        /**
     * LIST SEMUA REKAM MEDIS
     */
    public function index()
    {
        $allRekamMedis = DB::table('rekam_medis as rm')
            ->join('user as u', 'rm.dokter_pemeriksa', '=', 'u.iduser')
            ->select(
                'rm.idrekam_medis',
                'rm.created_at',
                'rm.anamnesa',
                'rm.diagnosa',
                'u.nama as dokter_pemeriksa'
            )
            ->orderByDesc('rm.created_at')
            ->get();

        return view('dokter.RekamMedis.index', compact('allRekamMedis'));
    }

    /**
     * DETAIL REKAM MEDIS
     */
    public function show(int $id)
    {
        // === data utama rekam medis ===
        $rekamMedis = DB::table('rekam_medis as rm')
            ->join('user as u', 'rm.dokter_pemeriksa', '=', 'u.iduser')
            ->select(
                'rm.*',
                'u.nama as dokter_pemeriksa'
            )
            ->where('rm.idrekam_medis', $id)
            ->first();

        if (!$rekamMedis) {
            return redirect()
                ->route('dokter.RekamMedis.index')
                ->with('error', 'Rekam Medis tidak ditemukan.');
        }

        // === detail tindakan terapi ===
        $detailList = DB::table('detail_rekam_medis as drm')
            ->join(
                'kode_tindakan_terapi as ktt',
                'drm.idkode_tindakan_terapi',
                '=',
                'ktt.idkode_tindakan_terapi'
            )
            ->select(
                'ktt.kode',
                'ktt.deskripsi_tindakan_terapi',
                'drm.detail'
            )
            ->where('drm.idrekam_medis', $id)
            ->orderBy('drm.iddetail_rekam_medis')
            ->get();

        return view('dokter.RekamMedis.show', compact(
            'rekamMedis',
            'detailList'
        ));
    }
}
