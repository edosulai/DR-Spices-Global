<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class RequestBuyTable extends DataTableComponent
{
    protected $listeners = [
        'requestBuyTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->addClass('w-5'),
            Column::make('Invoice', 'invoice')->sortable()->addClass('w-15'),
            Column::make('Pengguna', 'users_name')->sortable(),
            Column::make('Maggot', 'maggot_nama')->sortable()->addClass('w-12'),
            Column::make('Jumlah', 'jumlah')->sortable()->addClass('w-7'),
            Column::make('Status', 'statuses_nama')->sortable()->addClass('w-14'),
            Column::make('Waktu Permintaan', 'created_at')->sortable()->addClass('w-16'),
            Column::make('Aksi')->addClass('no-print')->addClass('w-7'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return RequestBuy::selectRaw("
                request_buys.*,
                @row:=@row+1 as no,
                users.name as users_name,
                REPLACE(JSON_EXTRACT(request_buys.maggot_data, '$[*].nama'), '\"', '') as maggot_nama,
                JSON_EXTRACT(request_buys.maggot_data, '$[*].jumlah') as jumlah,
                statuses.nama as statuses_nama
            ")
            ->join('users', 'request_buys.user_id', '=', 'users.id')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"), fn ($join) =>
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at')
            )
            ->orderBy('request_buys.updated_at', 'desc')
            ->when(
                $this->getFilter('search'),
                fn ($query, $term) =>
                $query
                    ->where('invoice', 'like', "%" . trim($term) . "%")
                    ->orWhere('users.name', 'like', "%" . trim($term) . "%")
                    ->orWhere('statuses.nama', 'like', "%" . trim($term) . "%")
                    ->orWhereRaw("REPLACE(JSON_EXTRACT(request_buys.maggot_data, '$[*].nama'), '\"', '') like '%" . trim($term) . "%'")
                    ->orWhereRaw("JSON_EXTRACT(request_buys.maggot_data, '$[*].jumlah') like '%" . trim($term) . "%'")
            );
    }

    public function rowView(): string
    {
        return 'livewire.request-buy-table';
    }
}
