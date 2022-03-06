<?php

namespace App\Http\Livewire;

use App\Models\Expenditure;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ExpenditureTable extends DataTableComponent
{
    public function mount()
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 1;
    }

    public function columns(): array
    {
        return [
            Column::make('No.')->format(fn () => ++$this->index),
            Column::make('No Faktur', 'faktur')->sortable()->searchable(),
            Column::make('ID Supplier', 'supplier_id')->sortable()->searchable(),
            Column::make('ID Rempah', 'spice_id')->sortable()->searchable(),
            Column::make('Jumlah', 'jumlah')->sortable()->searchable(),
            Column::make('Keterangan', 'ket')->sortable()->searchable()
        ];
    }

    public function query(): Builder
    {
        return Expenditure::query();
    }

    public function rowView(): string
    {
        return 'livewire.expenditure-table';
    }
}
