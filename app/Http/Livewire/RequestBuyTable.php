<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class RequestBuyTable extends DataTableComponent
{
    public function mount()
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 1;
    }

    public function columns(): array
    {
        return [
            Column::make('No.')->format(fn () => ++$this->index),
            Column::make('ID Pengguna', 'user_id')->sortable()->searchable(),
            Column::make('ID Rempah', 'spice_id')->sortable()->searchable(),
            Column::make('ID Status', 'status_id')->sortable()->searchable(),
            Column::make('Jumlah', 'jumlah')->sortable()->searchable()
        ];
    }

    public function query(): Builder
    {
        return RequestBuy::query();
    }

    public function rowView(): string
    {
        return 'livewire.request-buy-table';
    }
}
