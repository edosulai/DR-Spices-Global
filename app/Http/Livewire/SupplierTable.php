<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class SupplierTable extends DataTableComponent
{
    protected $listeners = [
        'supplierTableColumns' => 'columns',
    ];

    public function mount()
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 1;
    }

    public function columns(): array
    {
        return [
            Column::make('No.')->format(fn () => ++$this->index),
            Column::make('Nama', 'nama')->sortable()->searchable(),
            Column::make('Alamat', 'alamat')->sortable()->searchable(),
            Column::make('Telp', 'telp')->sortable()->searchable(),
            Column::make('Aksi')->addClass('no-print'),
        ];
    }

    public function query(): Builder
    {
        return Supplier::query();
    }

    public function rowView(): string
    {
        return 'livewire.supplier-table';
    }

    public function openModal($id = null)
    {
        $this->emit('supplierModal', $id);
    }

    public function openDeleteModal($id)
    {
        $this->emit('deleteSupplierModal', $id);
    }
}
