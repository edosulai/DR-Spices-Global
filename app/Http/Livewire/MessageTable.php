<?php

namespace App\Http\Livewire;

use App\Models\ContactUs;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MessageTable extends DataTableComponent
{
    protected $listeners = [
        'messageTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->searchable()->addClass('w-7'),
            Column::make('Nama', 'name')->sortable()->searchable(),
            Column::make('Email', 'email')->sortable()->searchable(),
            Column::make('Subjek', 'subject')->sortable()->searchable(),
            Column::make('Waktu', 'created_at')->sortable()->searchable(),
            Column::make('Aksi')->addClass('no-print')->addClass('w-7'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return ContactUs::query()->selectRaw('*, @row:=@row+1 as no')->latest();
    }

    public function rowView(): string
    {
        return 'livewire.message-table';
    }
}
