<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class User extends Component
{
    public $title;
    public $userModal = false;
    public $deleteUserModalConfirm = false;
    public $roles;
    public $form = [];

    protected $listeners = [
        'userModal' => 'openUserModal',
        'deleteUserModal' => 'openDeleteUserModal',
    ];

    protected $rules = [
        'form.role' => 'required|exists:roles,id',
    ];

    protected $validationAttributes = [
        'form.role' => 'Role User',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function openUserModal($id)
    {
        $user = ModelsUser::find($id);
        $this->form = $user->toArray();
        $this->form['role'] = $user->roles->first()->id;
        $this->form['created_at'] = Carbon::parse($user->created_at)->format('Y-m-d\TH:i');
        $this->userModal = true;
    }

    public function openDeleteUserModal($id)
    {
        $this->form = ModelsUser::find($id)->toArray();
        $this->deleteUserModalConfirm = true;
    }

    public function editUser()
    {
        $this->validate();

        $user = ModelsUser::find($this->form['id']);
        $role = Role::find($this->form['role']);
        $user->syncRoles($role->name);

        $this->userModal = false;
        $this->emit('userTableColumns');
    }

    public function deleteUser()
    {
        ModelsUser::destroy($this->form['id']);
        $this->deleteUserModalConfirm = false;
        $this->emit('userTableColumns');
    }

    public function render()
    {
        return view('livewire.user');
    }
}
