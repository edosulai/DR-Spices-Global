<?php

namespace App\Http\Livewire;

use App\Charts\EarningChart;
use App\Models\Expenditure;
use App\Models\Income;
use App\Support\Livewire\ChartComponent;
use App\Support\Livewire\ChartComponentData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Earning extends ChartComponent
{
    /**
     * @return string
     */
    protected function view(): string
    {
        return 'livewire.earning';
    }

    /**
     * @return string
     */
    protected function chartClass(): string
    {
        return EarningChart::class;
    }

    /**
     * @return \App\Support\Livewire\ChartComponentData
     */
    protected function chartData(): ChartComponentData
    {
        $incomes = Income::join(DB::raw("(
                select
                    sum(hrg_jual) as hrg_jual,
                    sum(jumlah) as jumlah,
                    id
                from
                    `request_buys`,
                    JSON_TABLE(
                        request_buys.spice_data,'$[*]'
                        COLUMNS(
                            NESTED PATH '$.hrg_jual'
                                COLUMNS (
                                    hrg_jual DECIMAL PATH '$'
                                ),
                            NESTED PATH '$.jumlah'
                                COLUMNS (
                                    jumlah DECIMAL PATH '$'
                                )
                        )
                    ) as jt group by id
                ) request_buys"), function ($join) {
            $join->on('incomes.request_buy_id', '=', 'request_buys.id');
        })
            ->whereYear('incomes.created_at', Carbon::now()->year)
            ->whereMonth('incomes.created_at', Carbon::now()->month)
            ->selectRaw("request_buys.hrg_jual * request_buys.jumlah as income_price, incomes.created_at, incomes.id")
            ->oldest()
            ->get();

        $outcomes = Expenditure::selectRaw("JSON_EXTRACT(spice_data, '$.hrg_jual') * jumlah as outcome_price, id")
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->oldest()
            ->get();

        $labels = $incomes->map(function (Income $income, $key) {
            return $income->created_at->format('M d');
        });

        $datasets = new Collection([
            'incomes' => $incomes->map(function (Income $income, $key) {
                return intval($income->income_price);
            }),
            'outcomes' => $outcomes->map(function (Expenditure $expenditure, $key) {
                return intval($expenditure->outcome_price);
            })
        ]);

        return (new ChartComponentData($labels, $datasets));
    }
}
