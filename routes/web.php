<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\RequestBuyController;
use App\Http\Controllers\SpiceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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
    return view('landing');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/detail', function () {
    return view('detail');
});

Route::group(['middleware' => ['role:admin', 'auth:sanctum', 'verified']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/dashboard/tertunda', RequestBuyController::class);
    Route::resource('/dashboard/pengeluaran', ExpenditureController::class);
    Route::resource('/dashboard/pendapatan', IncomeController::class);
    Route::resource('/dashboard/pengguna', UserController::class);
    Route::resource('/dashboard/pemasok', SupplierController::class);
    Route::resource('/dashboard/rempah', SpiceController::class);
    Route::resource('/dashboard/status', StatusController::class);

});
