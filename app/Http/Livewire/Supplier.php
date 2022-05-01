<?php

namespace App\Http\Livewire;

use App\Models\Supplier as ModelsSupplier;
use Livewire\Component;

class Supplier extends Component
{
    public $supplierModal = false;
    public $deleteSupplierModalConfirm = false;
    public $id_supplier = 0;

    public $title;

    public $nama;
    public $alamat;
    public $telp;

    public $aksiSupplierModal = 'tambahSupplier';
    public $buttonSupplierModal = 'Tambah';

    protected $listeners = [
        'supplierModal' => 'openSupplierModal',
        'deleteSupplierModal' => 'openDeleteSupplierModal',
    ];

    protected $rules = [
        'nama' => 'required|max:255',
        'alamat' => 'required|max:255',
        'telp' => 'required|max:255'
    ];

    public function render()
    {
        return view('livewire.supplier');
    }

    public function openSupplierModal($id = null)
    {
        if ($id) {
            $supplier = ModelsSupplier::find($id);
            if (!$supplier) return;
            $this->id_supplier = $supplier->id;
            $this->nama = $supplier->nama;
            $this->alamat = $supplier->alamat;
            $this->telp = $supplier->telp;
            $this->aksiSupplierModal = 'editSupplier';
            $this->buttonSupplierModal = 'Edit';
        } else {
            $this->nama = '';
            $this->alamat = '';
            $this->telp = '';
            $this->aksiSupplierModal = 'tambahSupplier';
            $this->buttonSupplierModal = 'Tambah';
        }

        $this->supplierModal = true;
    }

    public function openDeleteSupplierModal($id)
    {
        if ($id) {
            $supplier = ModelsSupplier::find($id);
            if (!$supplier) return;
            $this->id_supplier = $supplier->id;
            $this->nama = $supplier->nama;
        }

        $this->deleteSupplierModalConfirm = true;
    }

    public function tambahSupplier()
    {
        $this->validate();

        ModelsSupplier::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telp' => $this->telp
        ]);

        $this->supplierModal = false;

        $this->emit('supplierTableColumns');
    }

    public function editSupplier()
    {
        $this->validate();

        $supplier = ModelsSupplier::find($this->id_supplier);
        $supplier->nama = $this->nama;
        $supplier->alamat = $this->alamat;
        $supplier->telp = $this->telp;
        $supplier->save();

        $this->id_supplier = 0;
        $this->supplierModal = false;

        $this->emit('supplierTableColumns');
    }

    public function deleteSupplier()
    {
        ModelsSupplier::destroy($this->id_supplier);
        $this->id_supplier = 0;
        $this->deleteSupplierModalConfirm = false;

        $this->emit('supplierTableColumns');
    }
}
