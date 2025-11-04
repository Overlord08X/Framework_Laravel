<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\HomeController;

Route::get('/', function () {
    return view('/site/home');
});

Route::get('/site/home', [SiteController::class, 'home'])->name('home');
Route::get('/site/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/site/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/site/visimisi', [SiteController::class, 'visimisi'])->name('visimisi');
Route::get('/login', [SiteController::class, 'login'])->name('login');

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('cekKoneksi');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('isAdministrator')->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\admin\DashboardAdminController::class, 'index'])->name('admin.dashboard-admin');
    Route::get('/admin/DaftarJenisHewan', [App\Http\Controllers\admin\DaftarJenisHewanController::class, 'index'])->name('admin.DaftarJenisHewan.index');
    Route::get('/admin/DaftarKategori', [App\Http\Controllers\admin\DaftarKategoriController::class, 'index'])->name('admin.DaftarKategori.index');
    Route::get('/admin/DaftarKategoriKlinis', [App\Http\Controllers\admin\DaftarKategoriKlinisController::class, 'index'])->name('admin.DaftarKategoriKlinis.index');
    Route::get('/admin/DaftarKodeTindakanTerapi', [App\Http\Controllers\admin\DaftarKodeTindakanTerapiController::class, 'index'])->name('admin.DaftarKodeTindakanTerapi.index');
    Route::get('/admin/DaftarPet', [App\Http\Controllers\admin\DaftarPetController::class, 'index'])->name('admin.DaftarPet.index');
    Route::get('/admin/DaftarRasHewan', [App\Http\Controllers\admin\DaftarRasHewanController::class, 'index'])->name('admin.DaftarRasHewan.index');
    Route::get('/admin/DaftarRole', [App\Http\Controllers\admin\DaftarRoleController::class, 'index'])->name('admin.DaftarRole.index');
    Route::get('/admin/DaftarUser', [App\Http\Controllers\admin\DaftarUserController::class, 'index'])->name('admin.DaftarUser.index');
});
