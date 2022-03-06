<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserTable extends DataTableComponent
{
    protected $listeners = [
        'userTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('No.', 'no')->sortable()->searchable()->addClass('w-7'),
            Column::make('Name', 'name')->sortable()->searchable()->addClass('w-25'),
            Column::make('E-mail', 'email')->sortable()->searchable()->addClass('w-25'),
            Column::make('Waktu Daftar', 'created_at')->sortable()->searchable(),
            Column::make('Role')->addClass('w-10'),
            Column::make('Aksi')->addClass('no-print')->addClass('w-15'),
        ];
    }

    public function query(): Builder
    {
        DB::statement(DB::raw('set @row:=0'));
        return User::query()->with('roles')->selectRaw('*, @row:=@row+1 as no');
    }

    public function rowView(): string
    {
        return 'livewire.user-table';
    }

    public function openModal($id)
    {
        $this->emit('userModal', $id);
    }

    public function openDeleteModal($id)
    {
        $this->emit('deleteUserModal', $id);
    }
}
