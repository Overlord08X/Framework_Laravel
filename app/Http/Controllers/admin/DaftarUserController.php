<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DaftarUserController extends Controller
{
    public function index()
    {
        $User = User::whereHas('roleUser', function ($q) {
            $q->where('nama_role', '!=', 'Pemilik');
        })
            ->with('roleUser')
            ->get();

        return view('admin.DaftarUser.index', compact('User'));
    }

    public function create()
    {
        $Role = Role::where('nama_role', '!=', 'Pemilik')->get();
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

        User::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'idrole' => $validatedData['idrole'],
        ]);

        return redirect()->route('admin.DaftarUser.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $Role = Role::where('nama_role', '!=', 'Pemilik')->get();
        return view('admin.DaftarUser.edit', compact('user', 'Role'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'email' => 'required|email|unique:user,email,' . $id . ',iduser',
            'password' => 'nullable|string|min:6|confirmed',
            'idrole' => 'required|exists:role,idrole',
        ]);

        $user->nama = $validatedData['nama'];
        $user->email = $validatedData['email'];
        $user->idrole = $validatedData['idrole'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('admin.DaftarUser.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.DaftarUser.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
