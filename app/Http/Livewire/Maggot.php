<?php

namespace App\Http\Livewire;

use App\Models\Maggot as ModelsMaggot;
use App\Models\MaggotImage;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Maggot extends Component
{
    use WithFileUploads;

    public $title;
    public $form = [];
    public $maggotModal = false;
    public $deleteMaggotModal = false;
    public $aksiMaggotModal = 'tambahMaggot';
    public $buttonMaggotModal = 'Tambah';

    protected $listeners = [
        'maggotModal' => 'openMaggotModal',
        'deleteMaggotModal' => 'openDeleteMaggotModal',
    ];

    protected $rules = [
        'form.nama' => 'required|unique:maggots,nama|max:255',
        'form.hrg_jual' => 'required|numeric',
        'form.stok' => 'required|integer',
        'form.unit' => 'required|max:32',
        'form.ket' => 'nullable',
    ];

    protected $validationAttributes = [
        'form.nama' => 'Nama Maggot',
        'form.hrg_jual' => 'Harga Maggot',
        'form.stok' => 'Stok Maggot',
        'form.unit' => 'Satuan Maggot',
        'form.ket' => 'Keterangan Maggot',
        'form.img.*' => 'Gambar Maggot', // 1MB Max
    ];

    // public function updated()
    // {
    //     if (array_key_exists('id', $this->form)) {
    //         $this->rules['form.nama'] = "required|unique:maggots,nama," . $this->form['id'] . "|max:255";
    //     }
    //     $this->validate($this->rules);
    // }

    public function removeImage($i)
    {
        $this->form['src'][$i] = '';
        $this->form['img'][$i] = '';
    }

    public function openMaggotModal($id = null)
    {
        if ($id) {
            $this->form = ModelsMaggot::where('maggots.id', $id)
                ->first()
                ->toArray();

            $this->form['src'] = MaggotImage::where('maggot_id', $this->form['id'])->select('image')->oldest()->get()->map(fn ($item) => $item->image)->toArray();
            $this->aksiMaggotModal = 'editMaggot';
            $this->buttonMaggotModal = 'Edit';
        } else {
            if ($this->aksiMaggotModal != 'tambahMaggot') {
                $this->form = [];
            }
            $this->form['unit'] = 'KG';
            $this->aksiMaggotModal = 'tambahMaggot';
            $this->buttonMaggotModal = 'Tambah';
        }

        $this->maggotModal = true;
    }

    public function openDeleteMaggotModal($id)
    {
        $this->form = ModelsMaggot::find($id)->toArray();
        $this->deleteMaggotModal = true;
    }

    public function tambahMaggot()
    {
        $this->validate();
        $this->form['img']->store('public/images/product');

        ModelsMaggot::create([
            'nama' => $this->form['nama'],
            'hrg_jual' => $this->form['hrg_jual'],
            'stok' => $this->form['stok'],
            'unit' => $this->form['unit'],
            'image' => $this->form['img']->hashName(),
            'ket' => $this->form['ket'],
        ]);

        $this->maggotModal = false;
        $this->emit('maggotTableColumns');
    }

    public function editMaggot()
    {
        if (array_key_exists('img', $this->form)) {
            foreach ($this->form['img'] as $key => $img) {
                if (!is_string($img)) {
                    $this->rules['form.img.' . $key] = 'image|max:1024';
                }
            }
        }

        $this->rules['form.nama'] = "required|unique:maggots,nama," . $this->form['id'] . "|max:255";
        $this->validate();

        $maggot = ModelsMaggot::find($this->form['id']);
        $maggot->nama = $this->form['nama'];
        $maggot->hrg_jual = $this->form['hrg_jual'];
        $maggot->stok = $this->form['stok'];
        $maggot->unit = $this->form['unit'];
        $maggot->ket = $this->form['ket'];
        $maggot->save();

        MaggotImage::where('maggot_id', $maggot->id)->delete();

        for ($i = 0; $i < 4; $i++) {
            if (array_key_exists('img', $this->form) && array_key_exists($i, $this->form['img']) && $this->form['img'][$i] != '') {
                $this->form['img'][$i]->store('public/images/products');
                MaggotImage::create([
                    'maggot_id' => $maggot->id,
                    'image' => $this->form['img'][$i]->hashName()
                ]);
            } else if (array_key_exists('src', $this->form) && array_key_exists($i, $this->form['src']) && $this->form['src'][$i] != '') {
                MaggotImage::create([
                    'maggot_id' => $maggot->id,
                    'image' => $this->form['src'][$i]
                ]);
            }
        }

        $this->maggotModal = false;
        $this->emit('maggotTableColumns');
    }

    public function deleteMaggot()
    {
        ModelsMaggot::destroy($this->form['id']);
        $this->deleteMaggotModal = false;
        $this->emit('maggotTableColumns');
    }

    public function render()
    {
        return view('livewire.maggot');
    }
}
