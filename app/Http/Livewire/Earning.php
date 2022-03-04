<?php

namespace App\Http\Livewire;

use App\Charts\EarningChart;
use App\Models\Expenditure;
use App\Models\Income;
use App\Support\Livewire\ChartComponent;
use App\Support\Livewire\ChartComponentData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
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
        $incomes = Income::join('spices', 'incomes.spice_id', '=', 'spices.id')
            ->whereYear('incomes.created_at', Carbon::now()->year)
            ->whereMonth('incomes.created_at', Carbon::now()->month)
            ->selectRaw('spices.hrg_jual * incomes.jumlah as income_price, incomes.created_at, incomes.id')
            ->get();

        $outcomes = Expenditure::join('spices', 'expenditures.spice_id', '=', 'spices.id')
            ->whereYear('expenditures.created_at', Carbon::now()->year)
            ->whereMonth('expenditures.created_at', Carbon::now()->month)
            ->selectRaw('spices.hrg_jual * expenditures.jumlah as outcome_price, expenditures.id')
            ->get();

        $labels = $incomes->map(function (Income $income, $key) {
            return $income->created_at->format('M d');
        });

        $datasets = new Collection([
            'incomes' => $incomes->map(function (Income $income, $key) {
                return number_format($income->income_price, 0, ',', '.');
            }),
            'outcomes' => $outcomes->map(function (Expenditure $expenditure, $key) {
                return number_format($expenditure->outcome_price, 0, ',', '.');
            })
        ]);

        return (new ChartComponentData($labels, $datasets));
    }
}
