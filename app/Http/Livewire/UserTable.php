<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class UserTable extends DataTableComponent
{
    protected $listeners = [
        'userTableColumns' => 'columns',
    ];

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Waktu Daftar', 'created_at')
                ->sortable()
                ->searchable(),
            Column::make('Role'),
            Column::make('Aksi')->addClass('no-print'),
        ];
    }

    public function query(): Builder
    {
        return User::query()->with('roles');
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
