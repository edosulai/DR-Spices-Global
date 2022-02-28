<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Spice;
use App\Models\Income;
use App\Models\Expenditure;
use App\Models\RequestBuy;

class DashboardController extends Controller
{
    /**
     * Display dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income = Income::join('spices', 'incomes.spice_id', '=', 'spices.id')
            ->whereYear('incomes.created_at', Carbon::now()->year)
            ->whereMonth('incomes.created_at', Carbon::now()->month)
            ->selectRaw('spices.hrg_jual * incomes.jumlah as income_price')
            ->get()
            ->sum('income_price');

        $outcome = Expenditure::join('spices', 'expenditures.spice_id', '=', 'spices.id')
            ->whereYear('expenditures.created_at', Carbon::now()->year)
            ->whereMonth('expenditures.created_at', Carbon::now()->month)
            ->selectRaw('spices.hrg_jual * expenditures.jumlah as outcome_price')
            ->get()
            ->sum('outcome_price');

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'total' => Spice::all()->sum('stok'),
            'pengeluaran' => $outcome,
            'pendapatan' => $income,
            'pending' => RequestBuy::where(['status_id' => 3])->count()
        ]);
    }
}
