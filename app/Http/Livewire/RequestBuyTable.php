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
            Column::make('Pengguna', 'user_name')->sortable(),
            Column::make('Rempah', 'spice_name')->sortable()->addClass('w-12'),
            Column::make('Waktu Permintaan', 'created_at')->sortable()->addClass('w-16'),
            Column::make('Jumlah', 'jumlah')->sortable()->addClass('w-7'),
            Column::make('Status', 'status_name')->sortable()->addClass('w-14'),
            Column::make('Aksi')->addClass('no-print')->addClass('w-12'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return RequestBuy::query()
            ->join('users', 'request_buys.user_id', '=', 'users.id')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"), function ($join) {
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at');
            })->selectRaw("request_buys.*, @row:=@row+1 as no, users.name as user_name, JSON_EXTRACT(request_buys.spice_data, '$.nama') as spice_name, statuses.nama as status_name")
            ->when(
                $this->getFilter('search'),
                fn ($query, $term) =>
                $query
                    ->where('invoice', 'like', "%" . trim($term) . "%")
                    ->orwhere('users.name', 'like', "%" . trim($term) . "%")
                    ->orwhere('jumlah', 'like', "%" . trim($term) . "%")
                    ->orWhereRaw("JSON_EXTRACT(`request_buys`.`spice_data`, '$.nama') like '%" . trim($term) . "%'")
                    ->orWhere('statuses.nama', 'like', "%" . trim($term) . "%")
            );
    }

    public function rowView(): string
    {
        return 'livewire.request-buy-table';
    }
}
