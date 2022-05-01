<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Carbon;

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
        DB::statement(DB::raw("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')), @row:=0"));
        return RequestBuy::selectRaw("
                @row:=@row+1 as no,
                SUM(jt_request_buys.hrg_jual) as hrg_jual,
                SUM(jt_request_buys.jumlah) as jumlah,
                SUM(jt_request_buys.hrg_jual) * SUM(jt_request_buys.jumlah) as income_price,
                users.name as users_name,
                request_buys.invoice as invoice
            ")
            ->join(DB::raw("JSON_TABLE(request_buys.spice_data,'$[*]'
                COLUMNS(
                    NESTED PATH '$.hrg_jual' COLUMNS (hrg_jual DECIMAL PATH '$'),
                    NESTED PATH '$.jumlah' COLUMNS (jumlah DECIMAL PATH '$')
                )) as jt_request_buys"), fn ($join) => $join)
            ->join('users', 'request_buys.user_id', '=', 'users.id')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(
                DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"),
                fn ($join) =>
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at')
            )
            ->groupBy('request_buys.id')
            ->where(
                fn ($query) =>
                $query->where('statuses.nama', '=', 'Delivered')->orWhere('statuses.nama', '=', 'Rated')
            )
            ->when(
                $this->getFilter('search'),
                fn ($query, $term) =>
                $query->where(
                    fn ($query) =>
                    $query->where('users.name', 'like', "%" . trim($term) . "%")
                        ->orWhere('request_buys.invoice', 'like', "%" . trim($term) . "%")
                        ->orWhere('jumlah', 'like', "%" . trim($term) . "%")
                        ->orWhere('hrg_jual', 'like', "%" . trim($term) . "%")
                        ->orWhereRaw("hrg_jual * jumlah like '%" . trim($term) . "%'")
                )
            );
    }

    public function rowView(): string
    {
        return 'livewire.income-table';
    }
}
