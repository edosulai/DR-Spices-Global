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
            Column::make('No.', 'no')->sortable()->addClass('w-7'),
            Column::make('Invoice', 'invoice')->sortable()->addClass('w-19'),
            Column::make('Pengguna', 'users_name')->sortable(),
            Column::make('Jumlah', 'jumlah')->sortable()->addClass('w-10'),
            Column::make('Harga Satuan', 'hrg_jual')->sortable()->addClass('w-15'),
            Column::make('Pendapatan', 'income_price')->sortable()->addClass('w-15'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return Income::join('users', 'incomes.user_id', '=', 'users.id')
            ->join(DB::raw("(
                    select
                        id,
                        sum(hrg_jual) as hrg_jual,
                        sum(jumlah) as jumlah,
                        invoice
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
            ->selectRaw("
                *,
                @row:=@row+1 as no,
                request_buys.hrg_jual as hrg_jual,
                request_buys.jumlah as jumlah,
                request_buys.hrg_jual * request_buys.jumlah as income_price,
                users.name as users_name,
                request_buys.invoice as invoice
            ")
            ->when(
                $this->getFilter('search'),
                fn ($query, $term) =>
                $query
                    ->Where('users.name', 'like', "%" . trim($term) . "%")
                    ->orWhere('request_buys.jumlah', 'like', "%" . trim($term) . "%")
                    ->orWhere('request_buys.invoice', 'like', "%" . trim($term) . "%")
                    ->orWhere('request_buys.hrg_jual', 'like', "%" . trim($term) . "%")
                    ->orWhereRaw("request_buys.hrg_jual * request_buys.jumlah like '%" . trim($term) . "%'")
            );
    }

    public function rowView(): string
    {
        return 'livewire.income-table';
    }
}
