<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JenisHewan;

class DaftarJenisHewanController extends Controller
{
    public function index()
    {
        $JenisHewan = JenisHewan::all();
        return view('admin.DaftarJenisHewan.index', compact('JenisHewan'));
    }
}
