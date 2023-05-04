<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RefundTable extends DataTableComponent
{
    protected $listeners = [
        'refundTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->addClass('w-5'),
            Column::make('Invoice', 'invoice')->sortable()->addClass('w-19'),
            Column::make('Pengguna', 'users_name')->sortable(),
            Column::make('Status', 'statuses_nama')->sortable()->addClass('w-14'),
            Column::make('Refund Total', 'refund_total')->sortable()->addClass('w-13'),
            Column::make('Waktu Pembatalan', 'updated_at')->sortable()->addClass('w-17'),
            Column::make('Aksi')->addClass('no-print')->addClass('w-7'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw("set @row:=0"));
        return RequestBuy::where(
            fn($query) =>
            $query->where('statuses.nama', '=', 'Rejected')->orWhere('statuses.nama', '=', 'Canceled')
        )->whereNot(function ($query) {
            $query->where('request_buys.refund', '=', 0);
        })
            ->selectRaw("
                request_buys.*,
                @row:=@row+1 as no,
                users.name as users_name,
                statuses.nama as statuses_nama,
                SUBSTRING_INDEX(SUBSTRING_INDEX(request_buys.transaction_data, '\"gross_amount\":\"', -1), '\",\"', 1) as refund_total
            ")
            ->join('users', 'request_buys.user_id', '=', 'users.id')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(
                DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"),
                fn($join) =>
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at')
            )
            ->orderBy('request_buys.updated_at', 'desc')
            ->orderBy('request_buys.refund', 'asc')
            ->when(
                $this->getFilter('search'),
                fn($query, $term) =>
                $query
                    ->where('invoice', 'like', "%" . trim($term) . "%")
                    ->orWhere('users.name', 'like', "%" . trim($term) . "%")
                    ->orWhere('statuses.nama', 'like', "%" . trim($term) . "%")
                    ->orWhereRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(request_buys.transaction_data, '\"gross_amount\":\"', -1), '\",\"', 1) like '%" . trim($term) . "%'")
            );
    }

    public function rowView(): string
    {
        return 'livewire.refund-table';
    }
}
