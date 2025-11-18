<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarPemilikController extends Controller
{
    public function index()
    {
        $pemilik = DB::table('pemilik')->get();

        return view('admin.DaftarUser.index', compact('user'));
    }
}
