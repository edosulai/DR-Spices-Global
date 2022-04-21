<?php

namespace App\Http\Livewire;

use App\Models\Postage;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;


class PostageTable extends DataTableComponent
{
    protected $listeners = [
        'postageTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->addClass('w-7'),
            Column::make('Negara', 'countries_name')->sortable(),
            Column::make('Ongkos Kirim Per (KG)', 'cost')->sortable(),
            Column::make('Aksi')->addClass('no-print')->addClass('w-15'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return Postage::join('countries', 'postages.country_id', '=', 'countries.id')
            ->selectRaw('postages.*, @row:=@row+1 as no, countries.name as countries_name')
            ->when(
                $this->getFilter('search'),
                fn ($query, $term) =>
                $query
                    ->where('cost', 'like', "%" . trim($term) . "%")
                    ->orWhere('countries.name', 'like', "%" . trim($term) . "%")
            );
    }

    public function rowView(): string
    {
        return 'livewire.postage-table';
    }
}
