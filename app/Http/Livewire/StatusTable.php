<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StatusTable extends DataTableComponent
{
    protected $listeners = [
        'statusTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->searchable()->addClass('w-7'),
            Column::make('Nama', 'nama')->sortable()->searchable(),
            Column::make('Icon', 'icon')->sortable()->searchable(),
            // Column::make('Aksi')->addClass('no-print')->addClass('w-15'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return Status::query()->selectRaw('*, @row:=@row+1 as no');
    }

    public function rowView(): string
    {
        return 'livewire.status-table';
    }
}
