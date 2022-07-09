<?php

use Illuminate\Support\Carbon;
use App\Models\Spice;
use App\Models\Expenditure;
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

    Route::get('/dashboard', function ()
    {
        $income = RequestBuy::selectRaw("SUM(jt_request_buys.hrg_jual) * SUM(jt_request_buys.jumlah) as income_price")
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(
                DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"),
                fn ($join) =>
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at')
            )
            ->join(DB::raw("JSON_TABLE(request_buys.spice_data,'$[*]'
                COLUMNS(
                    NESTED PATH '$.hrg_jual' COLUMNS (hrg_jual DECIMAL PATH '$'),
                    NESTED PATH '$.jumlah' COLUMNS (jumlah DECIMAL PATH '$')
                )) as jt_request_buys"), fn ($join) => $join)
            ->groupBy('request_buys.id')
            ->where(
                fn ($query) =>
                $query->where('statuses.nama', '=', 'Delivered')->orWhere('statuses.nama', '=', 'Rated')
            )
            ->whereYear('traces.created_at', '=', Carbon::now()->year)
            ->whereMonth('traces.created_at', '=', Carbon::now()->month)
            ->get()
            ->sum('income_price');

        $outcome = Expenditure::selectRaw("JSON_EXTRACT(spice_data, '$.hrg_jual') * jumlah as outcome_price, created_at")
            ->whereYear('created_at', '=', Carbon::now()->year)
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->get()
            ->sum('outcome_price');

        $pending = RequestBuy::where('statuses.nama', 'Order Paid')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(
                DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"),
                fn ($join) =>
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at')
            )->count();

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'total' => Spice::all()->sum('stok'),
            'pengeluaran' => $outcome,
            'pendapatan' => $income,
            'pending' => $pending
        ]);
    })->name('dashboard');

    Route::get('/dashboard/tertunda', fn () => view('dashboard.request-buy', ['title' => 'Permintaan Pembelian']))->name('tertunda.index');
    Route::get('/dashboard/pengeluaran', fn () => view('dashboard.expenditure', ['title' => 'Pengeluaran']))->name('pengeluaran.index');
    Route::get('/dashboard/pendapatan', fn () => view('dashboard.income', ['title' => 'Pendapatan']))->name('pendapatan.index');
    Route::get('/dashboard/pengguna', fn () => view('dashboard.user', ['title' => 'Pengguna']))->name('pengguna.index');
    Route::get('/dashboard/pemasok', fn () => view('dashboard.supplier', ['title' => 'Pemasok']))->name('pemasok.index');
    Route::get('/dashboard/rempah', fn () => view('dashboard.spice', ['title' => 'Rempah']))->name('rempah.index');
    Route::get('/dashboard/pesan', fn () => view('dashboard.message', ['title' => 'Kontak Surat']))->name('pesan.index');
    Route::get('/dashboard/refund', fn () => view('dashboard.refund', ['title' => 'Pengembalian Dana']))->name('refund.index');
    Route::get('/dashboard/status', fn () => view('dashboard.status', ['title' => 'Status Pengiriman']))->name('status.index');
    Route::get('/dashboard/ongkir', fn () => view('dashboard.ongkir', ['title' => 'Ongkos Pengiriman']))->name('ongkir.index');
});

Route::get('/{product}', fn () => view('detail'))->name('detail');
