<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class DaftarUserController extends Controller
{
    public function index()
    {
        $User = User::all();
        return view('admin.DaftarUser.index', compact('User'));
    }
}
