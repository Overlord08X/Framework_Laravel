<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;

class DaftarPetController extends Controller
{
    public function index()
    {
        $Pet = Pet::with('pemilik.user', 'rashewan.jenishewan')->get();
        return view('admin.DaftarPet.index', compact('Pet'));
    }

    // Form tambah Pet
    public function create()
    {
        $Pemilik = Pemilik::with('user')->get();
        $RasHewan = RasHewan::with('jenishewan')->get();
        return view('admin.DaftarPet.create', compact('Pemilik', 'RasHewan'));
    }

    // Simpan Pet baru
    public function store(Request $request)
    {
        $validatedData = $this->validatePet($request);

        Pet::create([
            'nama' => trim($validatedData['nama']),
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'warna_tanda' => $validatedData['warna_tanda'] ?? null,
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'idpemilik' => $validatedData['idpemilik'],
            'idras_hewan' => $validatedData['idras_hewan'],
        ]);

        return redirect()->route('admin.DaftarPet.index')
            ->with('success', 'Data Pet berhasil disimpan.');
    }

    // Form edit Pet
    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $Pemilik = Pemilik::with('user')->get();
        $RasHewan = RasHewan::with('jenishewan')->get();

        return view('admin.DaftarPet.edit', compact('pet', 'Pemilik', 'RasHewan'));
    }

    // Update Pet
    public function update(Request $request, $id)
    {
        $validatedData = $this->validatePet($request);

        $pet = Pet::findOrFail($id);
        $pet->update([
            'nama' => trim($validatedData['nama']),
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'warna_tanda' => $validatedData['warna_tanda'] ?? null,
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'idpemilik' => $validatedData['idpemilik'],
            'idras_hewan' => $validatedData['idras_hewan'],
        ]);

        return redirect()->route('admin.DaftarPet.index')
            ->with('success', 'Data Pet berhasil diperbarui.');
    }

    // Hapus Pet
    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return redirect()->route('admin.DaftarPet.index')
            ->with('success', 'Data Pet berhasil dihapus.');
    }

    // Validasi input Pet
    protected function validatePet(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|in:M,F',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ], [
            'nama.required' => 'Nama pet wajib diisi.',
            'nama.string' => 'Nama pet harus berupa teks.',
            'nama.max' => 'Nama pet maksimal 100 karakter.',
            'nama.min' => 'Nama pet minimal 3 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus format tanggal.',
            'warna_tanda.string' => 'Warna/Tanda harus berupa teks.',
            'warna_tanda.max' => 'Warna/Tanda maksimal 45 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Jantan (M) atau Betina (F).',
            'idpemilik.required' => 'Pemilik wajib dipilih.',
            'idpemilik.exists' => 'Pemilik tidak valid.',
            'idras_hewan.required' => 'Ras hewan wajib dipilih.',
            'idras_hewan.exists' => 'Ras hewan tidak valid.',
        ]);
    }
}
