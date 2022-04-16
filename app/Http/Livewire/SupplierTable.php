<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class SupplierTable extends DataTableComponent
{
    protected $listeners = [
        'supplierTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->searchable()->addClass('w-7'),
            Column::make('Nama', 'nama')->sortable()->searchable(),
            Column::make('Alamat', 'alamat')->sortable()->searchable(),
            Column::make('Telp', 'telp')->sortable()->searchable()->addClass('w-15'),
            Column::make('Aksi')->addClass('no-print')->addClass('w-12'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return Supplier::query()->selectRaw('*, @row:=@row+1 as no');
    }

    public function rowView(): string
    {
        return 'livewire.supplier-table';
    }
}
