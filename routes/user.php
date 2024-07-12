<?php

use App\Http\Controllers\ControllerUser\BerandaUser;
use App\Http\Controllers\ControllerUser\BobotUser;
use App\Http\Controllers\ControllerUser\ListCafe;
use App\Http\Controllers\ControllerUser\Perhitungan\PerhitunganWP;
use App\Http\Controllers\ControllerUser\Pesan\KirimPesan;
use App\Http\Controllers\ControllerUser\Pesan\PesanUser;
use App\Http\Controllers\ControllerUser\Produks\DeleteProduk;
use App\Http\Controllers\ControllerUser\RekomendasiCafe;
use App\Http\Controllers\ControllerUser\Produks\TambahProduk;
use App\Http\Controllers\ControllerUser\Produks\UpdateProduk;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:User'])->group(function () {
    Route::get('/user/home', [BerandaUser::class, 'home'])->name('user.home')->middleware('check.ip');
    Route::get('/user/list-cafe', [ListCafe::class, 'cafe'])->name('user.cafe');
    Route::get('/user/rekomendasi-cafe', [RekomendasiCafe::class, 'rekomendasi'])->name('user.rekomendasi');
    Route::post('/user/rekomendasi-cafe/add', [TambahProduk::class, 'addProduk'])->name('user.addProduk');
    Route::delete('/user/rekomendasi-cafe/delete/{produkID}', [DeleteProduk::class, 'deleteProduk'])->name('user.deleteProduk');
    Route::put('/update-produk/{produkID}', [UpdateProduk::class, 'updateProduk'])->name('user.updateProduk');
    Route::post('/user/rekomendasi-cafe/bobot/addBobot', [BobotUser::class, 'addData'])->name('user.addData');
    Route::get('/rekomendasi-cafe/showPerhitunganWP', [PerhitunganWP::class, 'showPerhitunganWP'])->name('showPerhitunganWP');
    Route::get('/user/pesan', [PesanUser::class, 'Message'])->name('user.pesan');
    Route::post('/user/pesan/kirim', [KirimPesan::class, 'sendMessage'])->name('pesan.kirim');
});
