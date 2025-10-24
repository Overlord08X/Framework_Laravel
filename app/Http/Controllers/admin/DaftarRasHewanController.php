<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RasHewan;

class DaftarRasHewanController extends Controller
{
    public function index()
    {
        $RasHewan = RasHewan::all();
        return view('admin.DaftarRasHewan.index', compact('RasHewan'));
    }
}
