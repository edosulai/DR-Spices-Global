<?php

use App\Http\Controllers\DashboardController;
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

    Route::get('/dashboard/pending', function () {
        return view('dashboard.pending',[
            'title' => 'Permintaan Tertunda',
        ]);
    })->name('dashboard.pending');

    Route::get('/dashboard/outcome', function () {
        return view('dashboard.outcome',[
            'title' => 'Supplier',
        ]);
    })->name('dashboard.outcome');

    Route::get('/dashboard/income', function () {
        return view('dashboard.income',[
            'title' => 'Pendapatan',
        ]);
    })->name('dashboard.income');

    Route::get('/dashboard/user', function () {
        return view('dashboard.user',[
            'title' => 'Pengguna',
        ]);
    })->name('dashboard.user');

    Route::get('/dashboard/supply', function () {
        return view('dashboard.supply',[
            'title' => 'Supplier',
        ]);
    })->name('dashboard.supply');

    Route::get('/dashboard/rempah', function () {
        return view('dashboard.rempah',[
            'title' => 'Rempah',
        ]);
    })->name('dashboard.rempah');

});
