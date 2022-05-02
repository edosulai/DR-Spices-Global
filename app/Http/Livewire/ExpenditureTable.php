<?php

namespace App\Http\Livewire;

use App\Models\Expenditure;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ExpenditureTable extends DataTableComponent
{
    protected $listeners = [
        'expenditureTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->addClass('w-7'),
            Column::make('Supplier', "supplier_nama")->sortable(),
            Column::make('Rempah', "spice_nama")->sortable()->addClass('w-15'),
            Column::make('Jumlah', 'jumlah')->sortable()->addClass('w-10'),
            Column::make('Harga Satuan', "hrg_jual")->sortable()->addClass('w-15'),
            Column::make('Pengeluaran', 'outcome_price')->sortable()->addClass('w-15'),
            Column::make('Waktu', 'created_at')->sortable()->addClass('w-16'),
            Column::make('Aksi')->addClass('no-print')->addClass('w-12'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return Expenditure::selectRaw("
                *,
                @row:=@row+1 as no,
                JSON_EXTRACT(spice_data, '$.hrg_jual') as hrg_jual,
                JSON_EXTRACT(spice_data, '$.hrg_jual') * expenditures.jumlah as outcome_price,
                JSON_UNQUOTE(JSON_EXTRACT(supplier_data, '$.nama')) as supplier_nama,
                JSON_UNQUOTE(JSON_EXTRACT(spice_data, '$.nama')) as spice_nama
            ")
            ->latest()
            ->when(
                $this->getFilter('search'),
                fn ($query, $term) =>
                $query
                    ->where('jumlah', 'like', "%" . trim($term) . "%")
                    ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(supplier_data, '$.nama')) like '%" . trim($term) . "%'")
                    ->orWhereRaw("JSON_EXTRACT(spice_data, '$.hrg_jual') like '%" . trim($term) . "%'")
                    ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(spice_data, '$.nama')) like '%" . trim($term) . "%'")
                    ->orWhereRaw("JSON_EXTRACT(spice_data, '$.hrg_jual') * expenditures.jumlah like '%" . trim($term) . "%'")
            );
    }

    public function rowView(): string
    {
        return 'livewire.expenditure-table';
    }
}
