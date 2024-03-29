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

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->addClass('w-7'),
            Column::make('Gambar', 'image')->sortable()->searchable()->addClass('w-10'),
            Column::make('Nama', 'nama')->sortable()->searchable()->addClass('w-15'),
            Column::make('Unit', 'unit')->sortable()->searchable()->addClass('w-10'),
            Column::make('Harga Jual', 'hrg_jual')->sortable()->searchable()->addClass('w-15'),
            Column::make('Stok', 'stok')->sortable()->searchable()->addClass('w-10'),
            Column::make('Keterangan', 'ket')->sortable()->searchable(),
            Column::make('Aksi')->addClass('no-print')->addClass('w-12'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return Spice::selectRaw('spices.*, @row:=@row+1 as no, spice_images.image as image')
            ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
            ->latest();
    }

    public function rowView(): string
    {
        return 'livewire.spice-table';
    }
}
