<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarRoleController extends Controller
{
    public function index()
    {
        // Ambil semua role pakai Query Builder
        $Role = DB::table('role')->get();

        return view('admin.DaftarRole.index', compact('Role'));
    }

    public function create()
    {
        return view('admin.DaftarRole.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRole($request);

        DB::table('role')->insert([
            'nama_role' => trim($validatedData['nama_role'])
        ]);

        return redirect()->route('admin.DaftarRole.index')
            ->with('success', 'Data Role berhasil disimpan.');
    }

    public function edit($id)
    {
        $role = DB::table('role')->where('idrole', $id)->first();

        if (!$role) {
            abort(404);
        }

        return view('admin.DaftarRole.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateRole($request);

        DB::table('role')
            ->where('idrole', $id)
            ->update([
                'nama_role' => trim($validatedData['nama_role']),
            ]);

        return redirect()->route('admin.DaftarRole.index')
            ->with('success', 'Data Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('role')->where('idrole', $id)->delete();

        return redirect()->route('admin.DaftarRole.index')
            ->with('success', 'Data Role berhasil dihapus.');
    }

    // Helper Validasi
    protected function validateRole(Request $request)
    {
        return $request->validate([
            'nama_role' => 'required|string|max:50|min:3',
        ], [
            'nama_role.required' => 'Nama Role wajib diisi.',
            'nama_role.string' => 'Nama Role harus berupa teks.',
            'nama_role.max' => 'Nama Role maksimal 50 karakter.',
            'nama_role.min' => 'Nama Role minimal 3 karakter.',
        ]);
    }
}
