<?php

namespace App\Http\Livewire;

use App\Models\Spice as ModelsSpice;
use App\Models\SpiceImage;
use Illuminate\Support\Facades\DB;
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
        'form.hrg_jual' => 'required|numeric',
        'form.stok' => 'required|integer',
        'form.unit' => 'required|max:32',
        'form.ket' => 'nullable',
    ];

    protected $validationAttributes = [
        'form.nama' => 'Nama Rempah',
        'form.hrg_jual' => 'Harga Rempah',
        'form.stok' => 'Stok Rempah',
        'form.unit' => 'Satuan Rempah',
        'form.ket' => 'Keterangan Rempah',
        'form.img.*' => 'Gambar Rempah', // 1MB Max
    ];

    // public function updated()
    // {
    //     if (array_key_exists('id', $this->form)) {
    //         $this->rules['form.nama'] = "required|unique:spices,nama," . $this->form['id'] . "|max:255";
    //     }
    //     $this->validate($this->rules);
    // }

    public function removeImage($i)
    {
        $this->form['src'][$i] = '';
        $this->form['img'][$i] = '';
    }

    public function openSpiceModal($id = null)
    {
        if ($id) {
            $this->form = ModelsSpice::where('spices.id', $id)
                ->first()
                ->toArray();

            $this->form['src'] = SpiceImage::where('spice_id', $this->form['id'])->select('image')->oldest()->get()->map(fn ($item) => $item->image)->toArray();
            $this->aksiSpiceModal = 'editSpice';
            $this->buttonSpiceModal = 'Edit';
        } else {
            if ($this->aksiSpiceModal != 'tambahSpice') {
                $this->form = [];
            }
            $this->form['unit'] = 'KG';
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

        $spice = ModelsSpice::create([
            'nama' => $this->form['nama'],
            'hrg_jual' => $this->form['hrg_jual'],
            'stok' => $this->form['stok'],
            'unit' => $this->form['unit'],
            'ket' => $this->form['ket'],
        ]);

        foreach ($this->form['img'] as $key => $image) {
            $image->store('public/images/products');
            SpiceImage::create([
                'spice_id' => $spice->id,
                'image' => $image->hashName()
            ]);
        }

        $this->spiceModal = false;
        $this->emit('spiceTableColumns');
    }

    public function editSpice()
    {
        if (array_key_exists('img', $this->form)) {
            foreach ($this->form['img'] as $key => $img) {
                if (!is_string($img)) {
                    $this->rules['form.img.' . $key] = 'image|max:1024';
                }
            }
        }

        $this->rules['form.nama'] = "required|unique:spices,nama," . $this->form['id'] . "|max:255";
        $this->validate();

        $spice = ModelsSpice::find($this->form['id']);
        $spice->nama = $this->form['nama'];
        $spice->hrg_jual = $this->form['hrg_jual'];
        $spice->stok = $this->form['stok'];
        $spice->unit = $this->form['unit'];
        $spice->ket = $this->form['ket'];
        $spice->save();

        SpiceImage::where('spice_id', $spice->id)->delete();

        for ($i = 0; $i < 4; $i++) {
            if (array_key_exists('img', $this->form) && array_key_exists($i, $this->form['img']) && $this->form['img'][$i] != '') {
                $this->form['img'][$i]->store('public/images/products');
                SpiceImage::create([
                    'spice_id' => $spice->id,
                    'image' => $this->form['img'][$i]->hashName()
                ]);
            } else if (array_key_exists('src', $this->form) && array_key_exists($i, $this->form['src']) && $this->form['src'][$i] != '') {
                SpiceImage::create([
                    'spice_id' => $spice->id,
                    'image' => $this->form['src'][$i]
                ]);
            }
        }

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
