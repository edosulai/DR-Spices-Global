<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Spice;
use App\Models\Income;
use App\Models\Expenditure;
use App\Models\RequestBuy;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    }
}
