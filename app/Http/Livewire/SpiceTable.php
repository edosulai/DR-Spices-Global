<?php

namespace App\Http\Livewire;

use App\Models\Spice;
use App\Http\Livewire\Spice as SpiceWire;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SpiceTable extends DataTableComponent
{
    protected $listeners = [
        'spiceTableColumns' => 'columns',
    ];

    public function mount()
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 1;
    }

    public function columns(): array
    {
        return [
            Column::make(__('No.'))->format(fn () => ++$this->index),
            Column::make('Nama', 'nama')->sortable()->searchable(),
            Column::make('Harga Jual', 'hrg_jual')->sortable()->searchable(),
            Column::make('Stok', 'stok')->sortable()->searchable(),
            Column::make('Keterangan', 'ket')->sortable()->searchable(),
            Column::make('Aksi')->addClass('no-print'),
        ];
    }

    public function query(): Builder
    {
        return Spice::query();
    }

    public function rowView(): string
    {
        return 'livewire.spice-table';
    }

    public function openModal($id = null)
    {
        $this->emit('spiceModal', $id);
    }

    public function openDeleteModal($id)
    {
        $this->emit('deleteSpiceModal', $id);
    }
}
