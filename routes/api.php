<?php

use App\Http\Controllers\GameDetailController;
use App\Http\Controllers\GameListController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TransactionController;
use App\Models\GameDetail;
use App\Models\GameList;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/v1/gamelist', GameListController::class);
Route::resource('/v1/gamedetail', GameDetailController::class);
Route::resource('/v1/payment', PaymentMethodController::class);
// Route::resource('/v1/transaction', TransactionController::class);
Route::controller(TransactionController::class)->group(function () {
    Route::get('/v1/transaction', 'index')->name('transaction.index');
    Route::get('/v1/transaction/{id}', 'show')->name('transaction.show');
    Route::post('/v1/transaction', 'store')->name('transaction.store');
    Route::put('/v1/transaction', 'update')->name('transaction.update');
    Route::delete('/v1/transaction/{id}', 'delete')->name('transaction.delete');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
