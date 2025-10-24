<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;

class DaftarRoleController extends Controller
{
    public function index()
    {
        $Role = Role::all();
        return view('admin.DaftarRole.index', compact('Role'));
    }
}
