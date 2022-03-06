<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class User extends Component
{
    public $userModal = false;
    public $deleteUserModalConfirm = false;
    public $id_user = 0;

    public $title;

    public $name;
    public $email;
    public $created_at;
    public $role;
    public $roles;

    public $aksiUserModal = 'tambahUser';
    public $buttonUserModal = 'Tambah';

    protected $listeners = [
        'userModal' => 'openUserModal',
        'deleteUserModal' => 'openDeleteUserModal',
    ];

    public $rules = [
        'role' => 'required|exists:roles,id',
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function render()
    {
        return view('livewire.user');
    }

    public function openUserModal($id)
    {
        if (is_int($id)) {
            $user = ModelsUser::find($id);
            if (!$user) return;
            $this->id_user = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->created_at = Carbon::parse($user->created_at)->format('Y-m-d\TH:i');
            $this->role = $user->roles->first()->id;
            $this->aksiUserModal = 'editUser';
            $this->buttonUserModal = 'Edit';

            $this->userModal = true;
        }
    }

    public function openDeleteUserModal($id)
    {
        if (is_int($id)) {
            $user = ModelsUser::find($id);
            if (!$user) return;
            $this->id_user = $user->id;
            $this->name = $user->name;
        }

        $this->deleteUserModalConfirm = true;
    }

    public function editUser()
    {
        $this->validate();

        $user = ModelsUser::find($this->id_user);
        $roles = Role::find($this->role);

        if ($roles) $user->syncRoles($roles->name);

        $this->id_user = 0;
        $this->userModal = false;

        $this->emit('userTableColumns');
    }

    public function deleteUser()
    {
        ModelsUser::destroy($this->id_user);
        $this->id_user = 0;
        $this->deleteUserModalConfirm = false;

        $this->emit('userTableColumns');
    }
}
