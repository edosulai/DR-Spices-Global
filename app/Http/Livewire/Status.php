<?php

namespace App\Http\Livewire;

use App\Models\Status as ModelsStatus;
use Livewire\Component;

class Status extends Component
{
    public $statusModal = false;
    public $deleteStatusModalConfirm = false;
    public $id_status = 0;

    public $title;

    public $nama;
    public $icon;

    public $aksiStatusModal = 'tambahStatus';
    public $buttonStatusModal = 'Tambah';

    protected $listeners = [
        'statusModal' => 'openStatusModal',
        'deleteStatusModal' => 'openDeleteStatusModal',
    ];

    public $rules = [
        'nama' => 'required|unique:statuses,nama|max:255',
        'icon' => 'required|unique:statuses,icon|max:255'
    ];

    public function render()
    {
        return view('livewire.status');
    }

    public function openStatusModal($id = null)
    {
        if ($id) {
            $status = ModelsStatus::find($id);
            if (!$status) return;
            $this->id_status = $status->id;
            $this->nama = $status->nama;
            $this->icon = $status->icon;
            $this->aksiStatusModal = 'editStatus';
            $this->buttonStatusModal = 'Edit';
        } else {
            $this->nama = '';
            $this->icon = '';
            $this->aksiStatusModal = 'tambahStatus';
            $this->buttonStatusModal = 'Tambah';
        }

        $this->statusModal = true;
    }

    public function openDeleteStatusModal($id)
    {
        if ($id) {
            $status = ModelsStatus::find($id);
            if (!$status) return;
            $this->id_status = $status->id;
            $this->nama = $status->nama;
        }

        $this->deleteStatusModalConfirm = true;
    }

    public function tambahStatus()
    {
        $this->validate();

        ModelsStatus::create([
            'nama' => $this->nama,
            'icon' => $this->icon,
        ]);

        $this->statusModal = false;

        $this->emit('statusTableColumns');
    }

    public function editStatus()
    {
        $this->rules['nama'] = "required|unique:statuses,nama,$this->id_status|max:255";
        $this->validate();

        $status = ModelsStatus::find($this->id_status);
        $status->nama = $this->nama;
        $status->icon = $this->icon;
        $status->save();

        $this->id_status = 0;
        $this->statusModal = false;

        $this->emit('statusTableColumns');
    }

    public function deleteStatus()
    {
        ModelsStatus::destroy($this->id_status);
        $this->id_status = 0;
        $this->deleteStatusModalConfirm = false;

        $this->emit('statusTableColumns');
    }
}
