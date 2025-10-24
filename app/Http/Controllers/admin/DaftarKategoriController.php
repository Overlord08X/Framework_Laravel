<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kategori;

class DaftarKategoriController extends Controller
{
    public function index()
    {
        $Kategori = Kategori::all();
        return view('admin.DaftarKategori.index', compact('Kategori'));
    }
}
