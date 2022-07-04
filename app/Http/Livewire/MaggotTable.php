<?php

namespace App\Http\Livewire;

use App\Models\Maggot;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MaggotTable extends DataTableComponent
{
    protected $listeners = [
        'maggotTableColumns' => 'columns',
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
        return Maggot::selectRaw('maggots.*, @row:=@row+1 as no, maggot_images.image as image')
            ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
            ->latest();
    }

    public function rowView(): string
    {
        return 'livewire.maggot-table';
    }
}
