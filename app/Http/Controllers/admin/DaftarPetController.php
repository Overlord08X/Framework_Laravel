<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pet;

class DaftarPetController extends Controller
{
    public function index()
    {
        $Pet = Pet::with('pemilik.user', 'rashewan.jenishewan')->get();
        return view('admin.DaftarPet.index', compact('Pet'));
    }
}
