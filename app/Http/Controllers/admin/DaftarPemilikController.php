<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemilik;

class DaftarPemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::all();
        return view('admin.DaftarUser.index', compact('user'));
    }
}
