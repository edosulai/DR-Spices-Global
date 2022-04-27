<?php

namespace App\Http\Livewire;

use App\Charts\EarningChart;
use App\Models\Expenditure;
use App\Models\Income;
use App\Support\Livewire\ChartComponent;
use App\Support\Livewire\ChartComponentData;
use Carbon\CarbonPeriod;
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
            ->whereYear('incomes.created_at', '=', Carbon::now()->year)
            ->whereMonth('incomes.created_at', '=', Carbon::now()->month)
            ->selectRaw("SUM(request_buys.hrg_jual * request_buys.jumlah) as income_price, MAX(incomes.created_at) as created_at")
            ->groupBy(DB::raw('DATE(incomes.created_at)'))
            ->oldest()
            ->get();

        $outcomes = Expenditure::selectRaw("SUM(JSON_EXTRACT(spice_data, '$.hrg_jual') * jumlah) as outcome_price, MAX(created_at) as created_at")
            ->whereYear('created_at', '=', Carbon::now()->year)
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->oldest()
            ->get();

        $datePeriods = collect(CarbonPeriod::create(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth())->toArray())->map(function ($each) {
            return $each->format('M d');
        });

        $iteIn = 0;
        $iteOut = 0;
        $newIn = [];
        $newOut = [];
        foreach ($datePeriods as $key => $datePeriod) {
            if ($datePeriod == ($iteOut != count($outcomes) ? $outcomes[$iteOut]->created_at->format('M d') : false)) {
                $newOut[$key] = [
                    "outcome_price" => $outcomes[$iteOut]->outcome_price,
                    "created_at" => $outcomes[$iteOut]->created_at
                ];
                $iteOut++;
            } else {
                $newOut[$key] = [
                    "outcome_price" => 0,
                    "created_at" => Carbon::parse($datePeriod)
                ];
            }

            if ($datePeriod == ($iteIn != count($incomes) ? $incomes[$iteIn]->created_at->format('M d') : false)) {
                $newIn[$key] = [
                    "income_price" => $incomes[$iteIn]->income_price,
                    "created_at" => $incomes[$iteIn]->created_at
                ];
                $iteIn++;
            } else {
                $newIn[$key] = [
                    "income_price" => 0,
                    "created_at" => Carbon::parse($datePeriod)
                ];
            }
        }

        $incomes = collect($newIn)->recursive();
        $outcomes = collect($newOut)->recursive();

        $labels = $incomes->map(function ($income, $key) {
            return $income->created_at->format('M d');
        });

        $datasets = new Collection([
            'incomes' => $incomes->map(function ($income, $key) {
                return intval($income->income_price);
            }),
            'outcomes' => $outcomes->map(function ($expenditure, $key) {
                return intval($expenditure->outcome_price);
            })
        ]);

        return (new ChartComponentData($labels, $datasets));
    }
}
