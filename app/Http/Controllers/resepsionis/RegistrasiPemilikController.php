<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrasiPemilikController extends Controller
{
        /**
     * TAMPILKAN FORM REGISTRASI
     * GET /resepsionis/RegistrasiPemilik
     */
    public function index()
    {
        return view('resepsionis.RegistrasiPemilik.index');
    }

    /**
     * SIMPAN DATA
     * POST /resepsionis/RegistrasiPemilik
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'no_wa'    => 'required',
            'alamat'   => 'required',
        ]);

        $noWa = $this->normalizeWhatsapp($validated['no_wa']);

        DB::beginTransaction();

        try {
            $iduser = DB::table('user')->insertGetId([
                'nama'     => $validated['nama'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            DB::table('pemilik')->insert([
                'iduser' => $iduser,
                'no_wa'  => $noWa,
                'alamat' => $validated['alamat'],
            ]);

            DB::commit();

            return redirect()
                ->route('resepsionis.dashboard')
                ->with('success', 'Registrasi pemilik berhasil');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()
                ->withErrors(['error' => 'Gagal menyimpan data'])
                ->withInput();
        }
    }

    private function normalizeWhatsapp(string $raw): string
    {
        $digits = preg_replace('/\D+/', '', $raw);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        } elseif (str_starts_with($digits, '8')) {
            $digits = '62' . $digits;
        }

        return '+' . $digits;
    }
}
