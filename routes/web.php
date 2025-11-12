<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\DaftarJenisHewanController;
use App\Http\Controllers\admin\DaftarKategoriController;
use App\Http\Controllers\admin\DaftarKategoriKlinisController;
use App\Http\Controllers\admin\DaftarKodeTindakanTerapiController;
use App\Http\Controllers\admin\DaftarPetController;
use App\Http\Controllers\admin\DaftarRasHewanController;
use App\Http\Controllers\admin\DaftarRoleController;
use App\Http\Controllers\admin\DaftarUserController;
use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\App;

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
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard-admin');

    Route::get('/admin/DaftarJenisHewan', [DaftarJenisHewanController::class, 'index'])->name('admin.DaftarJenisHewan.index');
    Route::get('/admin/DaftarJenisHewan/create', [DaftarJenisHewanController::class, 'create'])->name('admin.DaftarJenisHewan.create');
    Route::post('/admin/DaftarJenisHewan/store', [DaftarJenisHewanController::class, 'store'])->name('admin.DaftarJenisHewan.store');
    Route::get('/admin/DaftarJenisHewan/{id}/edit', [DaftarJenisHewanController::class, 'edit'])->name('admin.DaftarJenisHewan.edit');
    Route::put('/admin/DaftarJenisHewan/{id}', [DaftarJenisHewanController::class, 'update'])->name('admin.DaftarJenisHewan.update');
    Route::delete('/admin/DaftarJenisHewan/{id}', [DaftarJenisHewanController::class, 'destroy'])->name('admin.DaftarJenisHewan.destroy');

    Route::get('/admin/DaftarKategori', [DaftarKategoriController::class, 'index'])->name('admin.DaftarKategori.index');
    Route::get('/admin/DaftarKategori/create', [DaftarKategoriController::class, 'create'])->name('admin.DaftarKategori.create');
    Route::post('/admin/DaftarKategori/store', [DaftarKategoriController::class, 'store'])->name('admin.DaftarKategori.store');
    Route::get('/admin/DaftarKategori/{id}/edit', [DaftarKategoriController::class, 'edit'])->name('admin.DaftarKategori.edit');
    Route::put('/admin/DaftarKategori/{id}', [DaftarKategoriController::class, 'update'])->name('admin.DaftarKategori.update');
    Route::delete('/admin/DaftarKategori/{id}', [DaftarKategoriController::class, 'destroy'])->name('admin.DaftarKategori.destroy');

    Route::get('/admin/DaftarKategoriKlinis', [DaftarKategoriKlinisController::class, 'index'])->name('admin.DaftarKategoriKlinis.index');
    Route::get('/admin/DaftarKategoriKlinis/create', [DaftarKategoriKlinisController::class, 'create'])->name('admin.DaftarKategoriKlinis.create');
    Route::post('/admin/DaftarKategoriKlinis/store', [DaftarKategoriKlinisController::class, 'store'])->name('admin.DaftarKategoriKlinis.store');
    Route::get('/admin/DaftarKategoriKlinis/{id}/edit', [DaftarKategoriKlinisController::class, 'edit'])->name('admin.DaftarKategoriKlinis.edit');
    Route::put('/admin/DaftarKategoriKlinis/{id}', [DaftarKategoriKlinisController::class, 'update'])->name('admin.DaftarKategoriKlinis.update');
    Route::delete('/admin/DaftarKategoriKlinis/{id}', [DaftarKategoriKlinisController::class, 'destroy'])->name('admin.DaftarKategoriKlinis.destroy');

    Route::get('/admin/DaftarKodeTindakanTerapi', [DaftarKodeTindakanTerapiController::class, 'index'])->name('admin.DaftarKodeTindakanTerapi.index');
    Route::get('/admin/DaftarKodeTindakanTerapi/create', [DaftarKodeTindakanTerapiController::class, 'create'])->name('admin.DaftarKodeTindakanTerapi.create');
    Route::post('/admin/DaftarKodeTindakanTerapi/store', [DaftarKodeTindakanTerapiController::class, 'store'])->name('admin.DaftarKodeTindakanTerapi.store');
    Route::get('/admin/DaftarKodeTindakanTerapi/{id}/edit', [DaftarKodeTindakanTerapiController::class, 'edit'])->name('admin.DaftarKodeTindakanTerapi.edit');
    Route::put('/admin/DaftarKodeTindakanTerapi/{id}', [DaftarKodeTindakanTerapiController::class, 'update'])->name('admin.DaftarKodeTindakanTerapi.update');
    Route::delete('/admin/DaftarKodeTindakanTerapi/{id}', [DaftarKodeTindakanTerapiController::class, 'destroy'])->name('admin.DaftarKodeTindakanTerapi.destroy');

    Route::get('/admin/DaftarPet', [DaftarPetController::class, 'index'])->name('admin.DaftarPet.index');
    Route::get('/admin/DaftarPet/create', [DaftarPetController::class, 'create'])->name('admin.DaftarPet.create');
    Route::post('/admin/DaftarPet/store', [DaftarPetController::class, 'store'])->name('admin.DaftarPet.store');
    Route::get('/admin/DaftarPet/{id}/edit', [DaftarPetController::class, 'edit'])->name('admin.DaftarPet.edit');
    Route::put('/admin/DaftarPet/{id}', [DaftarPetController::class, 'update'])->name('admin.DaftarPet.update');
    Route::delete('/admin/DaftarPet/{id}', [DaftarPetController::class, 'destroy'])->name('admin.DaftarPet.destroy');

    Route::get('/admin/DaftarRasHewan', [DaftarRasHewanController::class, 'index'])->name('admin.DaftarRasHewan.index');
    Route::get('/admin/DaftarRasHewan/create', [DaftarRasHewanController::class, 'create'])->name('admin.DaftarRasHewan.create');
    Route::post('/admin/DaftarRasHewan/store', [DaftarRasHewanController::class, 'store'])->name('admin.DaftarRasHewan.store');
    Route::get('/admin/DaftarRasHewan/{id}/edit', [DaftarRasHewanController::class, 'edit'])->name('admin.DaftarRasHewan.edit');
    Route::put('/admin/DaftarRasHewan/{id}', [DaftarRasHewanController::class, 'update'])->name('admin.DaftarRasHewan.update');
    Route::delete('/admin/DaftarRasHewan/{id}', [DaftarRasHewanController::class, 'destroy'])->name('admin.DaftarRasHewan.destroy');

    Route::get('/admin/DaftarRole', [DaftarRoleController::class, 'index'])->name('admin.DaftarRole.index');
    Route::get('/admin/DaftarRole/create', [DaftarRoleController::class, 'create'])->name('admin.DaftarRole.create');
    Route::post('/admin/DaftarRole/store', [DaftarRoleController::class, 'store'])->name('admin.DaftarRole.store');
    Route::get('/admin/DaftarRole/{id}/edit', [DaftarRoleController::class, 'edit'])->name('admin.DaftarRole.edit');
    Route::put('/admin/DaftarRole/{id}', [DaftarRoleController::class, 'update'])->name('admin.DaftarRole.update');
    Route::delete('/admin/DaftarRole/{id}', [DaftarRoleController::class, 'destroy'])->name('admin.DaftarRole.destroy');

    Route::get('/admin/DaftarUser', [DaftarUserController::class, 'index'])->name('admin.DaftarUser.index');
    Route::get('/admin/DaftarUser/create', [DaftarUserController::class, 'create'])->name('admin.DaftarUser.create');
    Route::post('/admin/DaftarUser/store', [DaftarUserController::class, 'store'])->name('admin.DaftarUser.store');
    Route::get('/admin/DaftarUser/{id}/edit', [DaftarUserController::class, 'edit'])->name('admin.DaftarUser.edit');
    Route::put('/admin/DaftarUser/{id}', [DaftarUserController::class, 'update'])->name('admin.DaftarUser.update');
    Route::delete('/admin/DaftarUser/{id}', [DaftarUserController::class, 'destroy'])->name('admin.DaftarUser.destroy');
});
