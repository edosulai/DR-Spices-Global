<?php

namespace App\Http\Livewire;

use App\Models\Income;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IncomeTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->searchable()->addClass('w-7'),
            Column::make('No Faktur', 'faktur')->sortable()->searchable()->addClass('w-15'),
            Column::make('Pengguna', 'user_name')->sortable()->searchable()->addClass('w-20'),
            Column::make('Rempah', 'spice_name')->sortable()->searchable()->addClass('w-15'),
            Column::make('Jumlah', 'jumlah')->sortable()->searchable()->addClass('w-10'),
            Column::make('Harga Satuan', 'hrg_jual')->sortable()->searchable()->addClass('w-15'),
            Column::make('Pendapatan', 'income_price')->sortable()->searchable(),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return Income::join('users', 'incomes.user_id', '=', 'users.id')
            ->join('spices', 'incomes.spice_id', '=', 'spices.id')
            ->selectRaw('*, @row:=@row+1 as no, spices.hrg_jual * incomes.jumlah as income_price, users.name as user_name, spices.nama as spice_name');
    }

    public function rowView(): string
    {
        return 'livewire.income-table';
    }
}
