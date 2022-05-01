<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\PostageController;
use App\Http\Controllers\RequestBuyController;
use App\Http\Controllers\SpiceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use App\Models\RequestBuy;
use App\Models\Trace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

Route::get('/', fn () => view('landing'))->name('home');
Route::get('/contact-us', fn () => view('contact-us', ['title' => 'Contact Us']))->name('contact');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/my-account', fn () => view('my-account'))->name('account');

    Route::get('/cart', fn () => view('cart'))->name('cart');

    Route::get('/checkout', function () {
        if (Cart::where('user_id', Auth::id())->get()->isEmpty()) {
            return redirect()->route('cart');
        }
        return view('checkout');
    })->name('checkout');

    Route::get('/purchase/{invoice}', function ($param) {
        $invoice = base64_decode($param);
        $request_buy = RequestBuy::where('invoice', $invoice)->where('user_id', Auth::id())->first();
        if (!$request_buy) return abort(404);

        $detailOrder = RequestBuy::where('request_buys.id', $request_buy->id)->where('request_buys.user_id', Auth::id())
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"), function ($join) {
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at');
            })->first();

        $traceOrder = Trace::where('request_buy_id', $detailOrder->id)
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->selectRaw('statuses.*')
            ->get();

        return view('listed-order', [
            'title' => 'Confirmation',
            'detailOrder' => $detailOrder,
            'traceOrder' => $traceOrder,
            'param' => $param
        ]);
    })->name('purchase');
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
    Route::resource('/dashboard/ongkir', PostageController::class);
});

Route::get('/{product}', fn () => view('detail'))->name('detail');
