<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class DaftarRoleController extends Controller
{
    public function index()
    {
        $Role = Role::all();
        return view('admin.DaftarRole.index', compact('Role'));
    }

    public function create()
    {
        return view('admin.DaftarRole.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRole($request);

        Role::create([
            'nama_role' => trim($validatedData['nama_role']),
        ]);

        return redirect()->route('admin.DaftarRole.index')
            ->with('success', 'Data Role berhasil disimpan.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.DaftarRole.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateRole($request);

        $role = Role::findOrFail($id);
        $role->update([
            'nama_role' => trim($validatedData['nama_role']),
        ]);

        return redirect()->route('admin.DaftarRole.index')
            ->with('success', 'Data Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.DaftarRole.index')
            ->with('success', 'Data Role berhasil dihapus.');
    }

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
