<?php

use App\Http\Controllers\NasabahController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah.index');
Route::post('/nasabah', [NasabahController::class, 'store'])->name('nasabah.store');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
