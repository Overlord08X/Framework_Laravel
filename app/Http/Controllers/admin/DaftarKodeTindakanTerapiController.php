<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KodeTindakanTerapi;

class DaftarKodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $KodeTindakanTerapi = KodeTindakanTerapi::all();
        return view('admin.DaftarKodeTindakanTerapi.index', compact('KodeTindakanTerapi'));
    }
}
