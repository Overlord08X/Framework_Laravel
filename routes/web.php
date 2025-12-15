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
use App\Http\Controllers\dokter\DashboardDokterController;
use App\Http\Controllers\dokter\ProfilDokterController;
use App\Http\Controllers\dokter\RekamMedisController as RekamMedisDokterController;
use App\Http\Controllers\perawat\DashboardPerawatController;
use App\Http\Controllers\perawat\ProfilPerawatController;
use App\Http\Controllers\perawat\ManajemenPasienController;
use App\Http\Controllers\perawat\ReservasiController;
use App\Http\Controllers\perawat\RekamMedisController as RekamMedisPerawatController;
use App\Http\Controllers\resepsionis\DashboardResepsionisController;
use App\Http\Controllers\resepsionis\RegistrasiPemilikController;
use App\Http\Controllers\resepsionis\RegistrasiPetController;
use App\Http\Controllers\resepsionis\TemuDokterController;
use App\Http\Controllers\pemilik\DashboardPemilikController;
use App\Http\Controllers\pemilik\DaftarPetController as DaftarPetPemilikController;
use App\Http\Controllers\pemilik\JadwalTemuDokterController;
use App\Http\Controllers\pemilik\DaftarRekamMedisController;
use App\Http\Controllers\pemilik\DetailRekamMedisController;
use App\Http\Controllers\pemilik\ProfilPemilikController;
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

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');

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

Route::middleware('isPerawat')->group(function () {
    Route::get('/perawat/dashboard', [DashboardPerawatController::class, 'index'])->name('perawat.dashboard-perawat');

    Route::get('/perawat/Profil', [ProfilPerawatController::class, 'index'])->name('perawat.Profil.index');

    Route::get('/perawat/ManajemenPasien', [ManajemenPasienController::class, 'index'])->name('perawat.ManajemenPasien.index');

    Route::get('/perawat/Reservasi', [ReservasiController::class, 'index'])->name('perawat.Reservasi.index');

    Route::get('/perawat/RekamMedis', [RekamMedisPerawatController::class, 'index'])->name('perawat.RekamMedis.index');
    Route::get('/perawat/RekamMedis/store', [RekamMedisPerawatController::class, 'store'])->name('perawat.RekamMedis.store');
    Route::get('/perawat/RekamMedis/{id}', [RekamMedisPerawatController::class, 'show'])->name('perawat.RekamMedis.show');
});

Route::middleware('isResepsionis')->group(function () {
    Route::get('/resepsionis/dashboard', [DashboardResepsionisController::class,'index'])->name('resepsionis.dashboard-resepsionis');

    Route::get('/resepsionis/RegistrasiPemilik', [RegistrasiPemilikController::class,'index'])->name('resepsionis.RegistrasiPemilik.index');
    Route::get('/resepsionis/create', [RegistrasiPemilikController::class,'create'])->name('resepsionis.RegistrasiPemilik.create');
    Route::post('/resepsionis/store', [RegistrasiPemilikController::class,'store'])->name('resepsionis.RegistrasiPemilik.store');

    Route::get('/resepsionis/RegistrasiPet', [RegistrasiPetController::class,'index'])->name('resepsionis.RegistrasiPet.index');
    Route::get('/resepsionis/RegistrasiPet/create', [RegistrasiPetController::class,'create'])->name('resepsionis.RegistrasiPet.create');
    Route::post('/resepsionis/RegistrasiPet/store', [RegistrasiPetController::class,'store'])->name('resepsionis.RegistrasiPet.store');

    Route::get('/resepsionis/TemuDokter', [TemuDokterController::class,'index'])->name('resepsionis.TemuDokter.index');
    Route::post('/resepsionis/TemuDokter/create', [TemuDokterController::class,'create'])->name('resepsionis.TemuDokter.create');
    Route::get('/resepsionis/TemuDokter/store', [TemuDokterController::class,'store'])->name('resepsionis.TemuDokter.store');
});

Route::middleware('isDokter')->group(function () {
    Route::get('/dokter/dashboard', [DashboardDokterController::class,'index'])->name('dokter.dashboard-dokter');

    Route::get('/dokter/Profil', [ProfilDokterController::class, 'index'])->name('dokter.Profil.index');

    Route::get('/dokter/RekamMedis', [RekamMedisDokterController::class,'index'])->name('dokter.RekamMedis.index');
    Route::get('/dokter/RekamMedis/{id}', [RekamMedisDokterController::class,'show'])->name('dokter.RekamMedis.show');
});

Route::middleware('isPemilik')->group(function () {
    Route::get('/pemilik/dashboard', [DashboardPemilikController::class,'index'])->name('pemilik.dashboard-pemilik');

    Route::get('/pemilik/Profil', [ProfilPemilikController::class, 'index'])->name('pemilik.Profil.index');
    Route::get('/pemilik/Pet', [DaftarPetPemilikController::class, 'index'])->name('pemilik.Pet.index');
    Route::get('/pemilik/Jadwal', [JadwalTemuDokterController::class, 'index'])->name('pemilik.Jadwal.index');
    Route::get('/pemilik/RekamMedis', [DaftarRekamMedisController::class, 'index'])->name('pemilik.RekamMedis.index');
    Route::get('/pemilik/RekamMedis/{id}', [DetailRekamMedisController::class, 'detail'])->name('pemilik.RekamMedis.detail');
});