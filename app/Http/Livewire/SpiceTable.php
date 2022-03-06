<?php

namespace App\Http\Livewire;

use App\Models\Spice;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
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
            Column::make('No.', 'no')->sortable()->searchable()->addClass('w-7'),
            Column::make('Nama', 'nama')->sortable()->searchable()->addClass('w-15'),
            Column::make('Harga Jual', 'hrg_jual')->sortable()->searchable()->addClass('w-15'),
            Column::make('Stok', 'stok')->sortable()->searchable()->addClass('w-10'),
            Column::make('Keterangan', 'ket')->sortable()->searchable(),
            Column::make('Aksi')->addClass('no-print')->addClass('w-15'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return Spice::query()->selectRaw('*, @row:=@row+1 as no');
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
