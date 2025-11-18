<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DaftarUserController extends Controller
{
    public function index()
    {
        // Ambil user yang role-nya bukan "Pemilik"
        $User = DB::table('user')
            ->select(
                'user.iduser',
                'user.nama',
                'user.email',
                DB::raw('GROUP_CONCAT(role.nama_role SEPARATOR ", ") as roles')
            )
            ->leftJoin('role_user', 'role_user.iduser', '=', 'user.iduser')
            ->leftJoin('role', 'role.idrole', '=', 'role_user.idrole')
            ->groupBy('user.iduser', 'user.nama', 'user.email')
            ->get();

        return view('admin.DaftarUser.index', compact('User'));
    }

    public function create()
    {
        // Ambil role yang bukan Pemilik
        $Role = DB::table('role')
            ->where('nama_role', '!=', 'Pemilik')
            ->get();

        return view('admin.DaftarUser.create', compact('Role'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:6|confirmed',
            'idrole' => 'required|exists:role,idrole',
        ]);

        // 1. Insert ke tabel user
        $userId = DB::table('user')->insertGetId([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // 2. Insert role ke tabel pivot role_user
        DB::table('role_user')->insert([
            'iduser' => $userId,
            'idrole' => $validatedData['idrole'],
            'status' => 1,
        ]);

        return redirect()->route('admin.DaftarUser.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = DB::table('user')->where('iduser', $id)->first();

        if (!$user) abort(404);

        // Ambil role user dari tabel pivot
        $userRole = DB::table('role_user')
            ->where('iduser', $id)
            ->value('idrole'); // hanya ambil satu role

        // Ambil semua role yang bukan Pemilik
        $Role = DB::table('role')
            ->where('nama_role', '!=', 'Pemilik')
            ->get();

        return view('admin.DaftarUser.edit', compact('user', 'Role', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'email' => 'required|email|unique:user,email,' . $id . ',iduser',
            'password' => 'nullable|string|min:6|confirmed',
            'idrole' => 'required|exists:role,idrole',
        ]);

        // Update user
        DB::table('user')
            ->where('iduser', $id)
            ->update([
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'password' => !empty($validatedData['password'])
                    ? Hash::make($validatedData['password'])
                    : DB::raw('password'),
            ]);

        // Update role pivot
        DB::table('role_user')
            ->where('iduser', $id)
            ->update([
                'idrole' => $validatedData['idrole'],
                'status' => 1,
            ]);

        return redirect()->route('admin.DaftarUser.index')
            ->with('success', 'User berhasil diperbarui.');
    }


    public function destroy($id)
    {
        try {
            // Hapus relasi role user terlebih dahulu
            DB::table('role_user')->where('iduser', $id)->delete();

            // Setelah itu baru hapus user
            DB::table('user')->where('iduser', $id)->delete();

            return redirect()->route('admin.DaftarUser.index')
                ->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }


    // Helper
    protected function validateUser(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:6|confirmed',
            'idrole' => 'required|exists:role,idrole',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'idrole.required' => 'Role wajib dipilih.',
            'idrole.exists' => 'Role tidak valid.',
        ]);
    }

    protected function validateUserUpdate(Request $request, $id)
    {
        return $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'email' => 'required|email|unique:user,email,' . $id . ',iduser',
            'password' => 'nullable|string|min:6|confirmed',
            'idrole' => 'required|exists:role,idrole',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 6 karakter.',
            'idrole.required' => 'Role wajib dipilih.',
            'idrole.exists' => 'Role tidak valid.',
        ]);
    }
}
