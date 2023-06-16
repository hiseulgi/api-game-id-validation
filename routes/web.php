<?php

use App\Http\Controllers\ViewController;
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

// Route::get('data_peminjam', 'DataPeminjamController@index')->name('data_peminjam.index');

// Route::controller(ViewController::class)->group(function () {
//     Route::get('/', 'index')->name('gamelist.index');
//     Route::get('/detail/{gamecode}', 'gameDetail')->name('gamedetail.index');
//     Route::post('/transaction', 'storeTransaction')->name('transaksi.index');
// });

Route::get('/', [ViewController::class, 'index'])->name('gamelist.index');
Route::get('/detail/{gamecode}', [ViewController::class, 'gameDetail'])->name('gamedetail.index');
Route::post('/transaksi', [ViewController::class, 'storeTransaction'])->name('transaksi.index');