<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KategoriKlinis;

class DaftarKategoriKlinisController extends Controller
{
    public function index()
    {
        $KategoriKlinis = KategoriKlinis::all();
        return view('admin.DaftarKategoriKlinis.index', compact('KategoriKlinis'));
    }
}
