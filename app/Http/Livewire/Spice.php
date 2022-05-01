<?php

namespace App\Http\Livewire;

use App\Models\Spice as ModelsSpice;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Spice extends Component
{
    use WithFileUploads;

    public $title;
    public $form = [];
    public $spiceModal = false;
    public $deleteSpiceModal = false;
    public $aksiSpiceModal = 'tambahSpice';
    public $buttonSpiceModal = 'Tambah';

    protected $listeners = [
        'spiceModal' => 'openSpiceModal',
        'deleteSpiceModal' => 'openDeleteSpiceModal',
    ];

    protected $rules = [
        'form.nama' => 'required|unique:spices,nama|max:255',
        'form.hrg_jual' => 'required|integer',
        'form.stok' => 'required|integer',
        'form.unit' => 'required|max:32',
        'form.ket' => 'nullable',
        'form.img' => 'image|max:1024', // 1MB Max
    ];

    protected $validationAttributes = [
        'form.nama' => 'Nama Rempah',
        'form.hrg_jual' => 'Harga Rempah',
        'form.stok' => 'Stok Rempah',
        'form.unit' => 'Satuan Rempah',
        'form.ket' => 'Keterangan Rempah',
        'form.img' => 'Gambar Rempah', // 1MB Max
    ];

    public function updated()
    {
        if (array_key_exists('id', $this->form)) {
            $this->rules['form.nama'] = "required|unique:spices,nama," . $this->form['id'] . "|max:255";
        }
        $this->validate($this->rules);
    }

    public function openSpiceModal($id = null)
    {
        if ($id) {
            $this->form = ModelsSpice::find($id)->toArray();
            $this->form['src'] = asset('storage/images/product/' . $this->form['image']);
            $this->aksiSpiceModal = 'editSpice';
            $this->buttonSpiceModal = 'Edit';
        } else {
            if ($this->aksiSpiceModal != 'tambahSpice') {
                $this->form = [];
            }
            $this->aksiSpiceModal = 'tambahSpice';
            $this->buttonSpiceModal = 'Tambah';
        }

        $this->spiceModal = true;
    }

    public function openDeleteSpiceModal($id)
    {
        $this->form = ModelsSpice::find($id)->toArray();
        $this->deleteSpiceModal = true;
    }

    public function tambahSpice()
    {
        $this->validate();
        $this->form['img']->store('public/images/product');

        ModelsSpice::create([
            'nama' => $this->form['nama'],
            'hrg_jual' => $this->form['hrg_jual'],
            'stok' => $this->form['stok'],
            'unit' => $this->form['unit'],
            'image' => $this->form['img']->hashName(),
            'ket' => $this->form['ket'],
        ]);

        $this->spiceModal = false;
        $this->emit('spiceTableColumns');
    }

    public function editSpice()
    {
        if (!(array_key_exists('img', $this->form) && $this->form['img'] != null)) {
            unset($this->rules['form.img']);
        }
        $this->rules['form.nama'] = "required|unique:spices,nama," . $this->form['id'] . "|max:255";
        $this->validate();

        $spice = ModelsSpice::find($this->form['id']);
        $spice->nama = $this->form['nama'];
        $spice->hrg_jual = $this->form['hrg_jual'];
        $spice->stok = $this->form['stok'];
        $spice->unit = $this->form['unit'];
        if (array_key_exists('img', $this->form) && $this->form['img'] != null) {
            $this->form['img']->store('public/images/product');
            $spice->image = $this->form['img']->hashName();
        }
        $spice->ket = $this->form['ket'];
        $spice->save();

        $this->spiceModal = false;
        $this->emit('spiceTableColumns');
    }

    public function deleteSpice()
    {
        ModelsSpice::destroy($this->form['id']);
        $this->deleteSpiceModal = false;
        $this->emit('spiceTableColumns');
    }

    public function render()
    {
        return view('livewire.spice');
    }
}
