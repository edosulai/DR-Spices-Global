<?php

namespace App\Http\Livewire;

use App\Charts\EarningChart;
use App\Models\Expenditure;
use App\Models\RequestBuy;
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
        DB::statement(DB::raw("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))"));
        $incomes = RequestBuy::selectRaw("SUM(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(spice_data, '\"jumlah\":', -1), '}', 1), ',', 1) AS DECIMAL)) as jumlah")
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(
                DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"),
                fn($join) =>
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at')
            )
            ->groupBy(DB::raw('MONTH(traces.created_at)'))
            ->where(
                fn($query) =>
                $query->where('statuses.nama', '=', 'Delivered')->orWhere('statuses.nama', '=', 'Rated')
            )
            ->orderBy('traces.created_at', 'asc')
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
            if ($datePeriod == ($iteOut != $outcomes->count() ? $outcomes[$iteOut]->created_at->format('M d') : false)) {
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

            if ($datePeriod == ($iteIn != $incomes->count() ? $incomes[$iteIn]->created_at->format('M d') : false)) {
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
