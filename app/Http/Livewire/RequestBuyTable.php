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

    protected $model = RequestBuy::class;

    protected $listeners = [
        'requestBuyTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->addClass('w-7'),

            Column::make('Pengguna', 'user_name')->sortable()->searchable(function (Builder $query, $term) {
                return $query->orWhere('users.name', 'like', "%" . trim($term) . "%");
            }),

            Column::make('Rempah', 'spice_name')->sortable()->searchable(function (Builder $query, $term) {
                return $query->orWhereRaw("JSON_EXTRACT(`request_buys`.`spice_data`, '$.nama') like %" . trim($term) . "%");
            })->addClass('w-15'),

            Column::make('Waktu Permintaan', 'created_at')->sortable()->addClass('w-20'),
            Column::make('Jumlah', 'jumlah')->sortable()->addClass('w-10'),

            Column::make('Status', 'status_name')->sortable()->searchable(function (Builder $query, $term) {
                return $query->orWhere('statuses.nama', 'like', "%" . trim($term) . "%");
            })->addClass('w-15'),

            Column::make('Aksi')->addClass('no-print')->addClass('w-15'),
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
            })->selectRaw("request_buys.*, @row:=@row+1 as no, users.name as user_name, JSON_EXTRACT(request_buys.spice_data, '$.nama') as spice_name, statuses.nama as status_name");
    }

    public function rowView(): string
    {
        return 'livewire.request-buy-table';
    }

    public function openModal($id = null)
    {
        $this->emit('requestBuyModal', $id);
    }
}
