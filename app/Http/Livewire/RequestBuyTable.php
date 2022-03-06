<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class RequestBuyTable extends DataTableComponent
{
    public function mount()
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 1;
    }

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->searchable()->addClass('w-7'),
            Column::make('Pengguna', 'user_name')->sortable()->searchable(),
            Column::make('Rempah', 'spice_name')->sortable()->searchable()->addClass('w-15'),
            Column::make('Status', 'status_name')->sortable()->searchable()->addClass('w-15'),
            Column::make('Jumlah', 'jumlah')->sortable()->searchable()->addClass('w-10'),
            Column::make('Aksi')->addClass('no-print')->addClass('w-15'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return RequestBuy::join('users', 'request_buys.user_id', '=', 'users.id')
            ->join('spices', 'request_buys.spice_id', '=', 'spices.id')
            ->join('statuses', 'request_buys.status_id', '=', 'statuses.id')
            ->selectRaw('*, @row:=@row+1 as no, users.name as user_name, spices.nama as spice_name, statuses.nama as status_name, statuses.id as status_id');
    }

    public function rowView(): string
    {
        return 'livewire.request-buy-table';
    }
}