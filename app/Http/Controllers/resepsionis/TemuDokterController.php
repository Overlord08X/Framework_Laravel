<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TemuDokterController extends Controller
{
    /**
     * HALAMAN TEMU DOKTER
     */
    public function index()
    {
        // === ambil semua pet + pemilik ===
        $petList = DB::table('pet as p')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->select(
                'p.idpet',
                'p.nama',
                'u.nama as nama_pemilik'
            )
            ->orderBy('p.nama')
            ->get();

        // === daftar temu dokter hari ini ===
        $daftarHariIni = DB::table('temu_dokter as td')
            ->join('pet as p', 'td.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->select(
                'td.no_urut',
                'p.nama as nama_pet',
                'u.nama as nama_pemilik',
                'td.waktu_daftar',
                'td.status'
            )
            ->whereDate('td.waktu_daftar', now()->toDateString())
            ->orderBy('td.no_urut')
            ->get();

        return view('resepsionis.TemuDokter.index', compact(
            'petList',
            'daftarHariIni'
        ));
    }

    /**
     * DAFTAR TEMU DOKTER
     */
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|integer|exists:pet,idpet'
        ]);

        $idpet = $request->idpet;
        $iduser = Auth::user()->iduser;

        // === ambil role aktif user ===
        $roleUser = DB::table('role_user')
            ->where('iduser', $iduser)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            return back()
                ->withErrors(['error' => 'User tidak memiliki akses untuk mendaftar temu dokter.']);
        }

        DB::beginTransaction();

        try {
            // === hitung no urut hari ini ===
            $noUrut = DB::table('temu_dokter')
                ->whereDate('waktu_daftar', now()->toDateString())
                ->count() + 1;

            // === insert temu dokter ===
            DB::table('temu_dokter')->insert([
                'no_urut'        => $noUrut,
                'waktu_daftar'  => now(),
                'status'        => 'N',
                'idpet'         => $idpet,
                'idrole_user'   => $roleUser->idrole_user,
            ]);

            DB::commit();

            return redirect()
                ->route('resepsionis.TemuDokter.index')
                ->with('success', 'Berhasil daftar temu dokter.');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()
                ->withErrors(['error' => 'Gagal daftar. Silakan coba lagi.']);
        }
    }
}
