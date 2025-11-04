<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard-admin');
    }
}
