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
    public $ket;

    public $aksiStatusModal = 'tambahStatus';
    public $buttonStatusModal = 'Tambah';

    protected $listeners = [
        'statusModal' => 'openStatusModal',
        'deleteStatusModal' => 'openDeleteStatusModal',
    ];

    public $rules = [
        'nama' => 'required|unique:statuses,nama|max:255',
        'ket' => 'nullable'
    ];

    public function render()
    {
        return view('livewire.status');
    }

    public function openStatusModal($id = null)
    {
        if (is_int($id)) {
            $status = ModelsStatus::find($id);
            if (!$status) return;
            $this->id_status = $status->id;
            $this->nama = $status->nama;
            $this->ket = $status->ket;
            $this->aksiStatusModal = 'editStatus';
            $this->buttonStatusModal = 'Edit';
        } else {
            $this->nama = '';
            $this->ket = '';
            $this->aksiStatusModal = 'tambahStatus';
            $this->buttonStatusModal = 'Tambah';
        }

        $this->statusModal = true;
    }

    public function openDeleteStatusModal($id)
    {
        if (is_int($id)) {
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
            'ket' => $this->ket,
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
        $status->ket = $this->ket;
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
