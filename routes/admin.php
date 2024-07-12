<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerAdmin\Alternatif\DeleteAlternatif;
use App\Http\Controllers\ControllerAdmin\Alternatif\IndexAlternatif;
use App\Http\Controllers\ControllerAdmin\Alternatif\StoreAlternatif;
use App\Http\Controllers\ControllerAdmin\Alternatif\UpdateAlternatif;
use App\Http\Controllers\ControllerAdmin\Bobot\DeleteBobot;
use App\Http\Controllers\ControllerAdmin\Bobot\IndexBobot;
use App\Http\Controllers\ControllerAdmin\Bobot\StoreBobot;
use App\Http\Controllers\ControllerAdmin\Bobot\UpdateBobot;
use App\Http\Controllers\ControllerAdmin\Kriteria\DeleteKriteria;
use App\Http\Controllers\ControllerAdmin\Kriteria\IndexKriteria;
use App\Http\Controllers\ControllerAdmin\Kriteria\StoreKriteria;
use App\Http\Controllers\ControllerAdmin\Kriteria\UpdateKriteria;
use App\Http\Controllers\ControllerAdmin\Nilai\DeleteNilai;
use App\Http\Controllers\ControllerAdmin\Nilai\IndexNilai;
use App\Http\Controllers\ControllerAdmin\Nilai\StoreNilai;
use App\Http\Controllers\ControllerAdmin\Nilai\UpdateNilai;
use App\Http\Controllers\ControllerAdmin\DashboardController;
use App\Http\Controllers\ControllerAdmin\Pengaturan\DeleteAkun;
use App\Http\Controllers\ControllerAdmin\Pengaturan\IndexAkun;
use App\Http\Controllers\ControllerAdmin\Pengaturan\StoreAkun;
use App\Http\Controllers\ControllerAdmin\Pengaturan\UpdateAkun;
use App\Http\Controllers\ControllerAdmin\Pesan\DeletePesan;
use App\Http\Controllers\ControllerAdmin\Pesan\IndexPesan;
use App\Http\Controllers\ControllerAdmin\Pesan\ShowPesan;
use App\Http\Controllers\ControllerAdmin\Pesan\UpdatePesan;
use App\Http\Controllers\ControllerAdmin\Website\IndexWebsite;
use App\Http\Controllers\ControllerAdmin\Website\UpdateWebsite;

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/kriteria', [IndexKriteria::class, 'index'])->name('admin.kriteria');
    Route::post('/admin/kriteria/store', [StoreKriteria::class, 'store'])->name('kriteria.store');
    Route::put('/admin/kriteria/update/{column}', [UpdateKriteria::class, 'update'])->name('kriteria.update');
    Route::delete('/admin/kriteria/delete/{column}', [DeleteKriteria::class, 'delete'])->name('kriteria.delete');

    Route::get('/admin/alternatif', [IndexAlternatif::class, 'alternatif'])->name('admin.alternatif');
    Route::post('/admin/alternatif/store', [StoreAlternatif::class, 'store'])->name('alternatif.store');
    Route::put('/admin/alternatif/update/{produk}', [UpdateAlternatif::class, 'update'])->name('alternatif.update');
    Route::delete('/admin/alternatif/delete/{produk}', [DeleteAlternatif::class, 'destroy'])->name('alternatif.destroy');

    Route::get('/admin/pembobotan', [IndexBobot::class, 'index'])->name('admin.pembobotan');
    Route::post('/admin/pembobotan/store', [StoreBobot::class, 'store'])->name('pembobotan.store');
    Route::put('/admin/pembobotan/update/{bobot}', [UpdateBobot::class, 'update'])->name('pembobotan.update');
    Route::delete('/admin/pembobotan/delete/{bobot}', [DeleteBobot::class, 'destroy'])->name('pembobotan.destroy');

    Route::get('/admin/penilaian', [IndexNilai::class, 'index'])->name('admin.penilaian');
    Route::post('/admin/penilaian/store', [StoreNilai::class, 'store'])->name('penilaian.store');
    Route::put('/admin/penilaian/update/{produk}', [UpdateNilai::class, 'update'])->name('penilaian.update');
    Route::delete('/admin/penilaian/delete/{produk}', [DeleteNilai::class, 'destroy'])->name('penilaian.destroy');

    Route::get('/admin/pesan/{status}', [IndexPesan::class, 'index'])->name('admin.pesan');
    Route::get('/admin/read-mail/{id_message}/{previous_status}', [ShowPesan::class, 'readMail'])->name('read-mail');
    Route::put('/admin/pesan/delete', [DeletePesan::class, 'deleteSelected'])->name('pesan.delete.selected');
    Route::post('pesan/{id_message}/update-status', [UpdatePesan::class, 'updateStatus'])->name('pesan.updateStatus');

    Route::get('/admin/akun-admin', [IndexAkun::class, 'userAll'])->name('admin.akun');
    Route::post('/admin/akun-admin', [StoreAkun::class, 'store'])->name('akun.store');
    Route::put('/admin/akun-admin/update/{id}', [UpdateAkun::class, 'update'])->name('akun.update');
    Route::delete('/admin/akun-admin/delete/{id}', [DeleteAkun::class, 'destroy'])->name('akun.delete');
    
    Route::get('/admin/akun-user', [IndexAkun::class, 'akunUser'])->name('admin.akunUser');
    Route::post('/admin/akun-user', [StoreAkun::class, 'storeUser'])->name('akun.storeUser');
    Route::put('/admin/akun-user/update/{id}', [UpdateAkun::class, 'updateUser'])->name('akun.updateUser');
    Route::delete('/admin/akun-user/delete/{id}', [DeleteAkun::class, 'destroyUser'])->name('akun.deleteUser');

    Route::get('/admin/setting-site', [IndexWebsite::class, 'settingSite'])->name('admin.site');
    Route::put('/admin/setting-site/update', [UpdateWebsite::class, 'updateSite'])->name('site.update');
});
