<?php

use App\Http\Controllers\tokoController;
use App\Http\Controllers\pemesananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('toko', tokoController::class);
Route::get('toko', [tokoController::class, 'index'])->name('toko.index');
Route::get('toko/create', [tokoController::class, 'create'])->name('toko.create');
Route::post('toko', [tokoController::class, 'store'])->name('toko.store');

Route::resource('pemesanan', pemesananController::class);
Route::get('pemesanan', [pemesananController::class, 'index'])->name('pemesanan.index');
Route::get('pemesanan/create', [pemesananController::class, 'create'])->name('pemesanan.create');
Route::post('pemesanan/store', [pemesananController::class, 'store'])->name('pemesanan.store');