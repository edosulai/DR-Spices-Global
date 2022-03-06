<?php

namespace App\Http\Livewire;

use App\Models\Spice as ModelsSpice;
use Livewire\Component;
use Livewire\WithPagination;

class Spice extends Component
{
    public $spiceModal = false;
    public $deleteSpiceModalConfirm = false;
    public $id_spice = 0;

    public $title;

    public $nama;
    public $hrg_jual;
    public $stok;
    public $ket;

    public $aksiSpiceModal = 'tambahSpice';
    public $buttonSpiceModal = 'Tambah';

    protected $listeners = [
        'spiceModal' => 'openSpiceModal',
        'deleteSpiceModal' => 'openDeleteSpiceModal',
    ];

    public $rules = [
        'nama' => 'required|unique:spices,nama|max:255',
        'hrg_jual' => 'required|integer',
        'stok' => 'required|integer',
        'ket' => 'nullable'
    ];

    public function render()
    {
        return view('livewire.spice');
    }

    public function openSpiceModal($id = null)
    {
        if (is_int($id)) {
            $spice = ModelsSpice::find($id);
            if (!$spice) return;
            $this->id_spice = $spice->id;
            $this->nama = $spice->nama;
            $this->hrg_jual = $spice->hrg_jual;
            $this->stok = $spice->stok;
            $this->ket = $spice->ket;
            $this->aksiSpiceModal = 'editSpice';
            $this->buttonSpiceModal = 'Edit';
        } else {
            $this->nama = '';
            $this->hrg_jual = '';
            $this->stok = '';
            $this->ket = '';
            $this->aksiSpiceModal = 'tambahSpice';
            $this->buttonSpiceModal = 'Tambah';
        }

        $this->spiceModal = true;
    }

    public function openDeleteSpiceModal($id)
    {
        if (is_int($id)) {
            $spice = ModelsSpice::find($id);
            if (!$spice) return;
            $this->id_spice = $spice->id;
            $this->nama = $spice->nama;
        }
        
        $this->deleteSpiceModalConfirm = true;
    }

    public function tambahSpice()
    {
        $this->validate();

        ModelsSpice::create([
            'nama' => $this->nama,
            'hrg_jual' => $this->hrg_jual,
            'stok' => $this->stok,
            'ket' => $this->ket,
        ]);

        $this->spiceModal = false;

        $this->emit('spiceTableColumns');
    }

    public function editSpice()
    {
        $this->rules['nama'] = "required|unique:spices,nama,$this->id_spice|max:255";
        $this->validate();

        $spice = ModelsSpice::find($this->id_spice);
        $spice->nama = $this->nama;
        $spice->hrg_jual = $this->hrg_jual;
        $spice->stok = $this->stok;
        $spice->ket = $this->ket;
        $spice->save();

        $this->id_spice = 0;
        $this->spiceModal = false;

        $this->emit('spiceTableColumns');
    }

    public function deleteSpice()
    {
        ModelsSpice::destroy($this->id_spice);
        $this->id_spice = 0;
        $this->deleteSpiceModalConfirm = false;

        $this->emit('spiceTableColumns');
    }
}
