<?php

namespace App\Http\Livewire;

use App\Models\Spice as ModelsSpice;
use Livewire\Component;
use Livewire\WithPagination;

class Spice extends Component
{
    use WithPagination;
    
    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $spiceModal = false;
    public $deleteSpiceModalConfirm = false;
    public $id_rempah = 0;

    public $title;

    public $nama;
    public $hrg_jual;
    public $stok;
    public $ket;

    public $aksiSpiceModal = 'tambahSpice';
    public $buttonSpiceModal = 'Tambah';

    public $rules = [
        'nama' => 'required|unique:spices,nama|max:255',
        'hrg_jual' => 'required|integer',
        'stok' => 'required|integer',
        'ket' => 'nullable'
    ];

    private function headerConfig()
    {
        return [
            'id' => [
                'label' => 'ID',
                'style' => 'width: 7% !important;',
                'func' => function ($value) {
                    return $value->id;
                }
            ],
            'nama' => [
                'label' => 'Nama',
                'style' => 'width: 15% !important;',
                'func' => function ($value) {
                    return $value->nama;
                }
            ],
            'hrg_jual' => [
                'label' => 'Harga Jual',
                'style' => 'width: 13% !important;',
                'func' => function ($value) {
                    return "Rp. " . number_format($value->hrg_jual, 0, ',', '.');
                }
            ],
            'stok' => [
                'label' => 'Stok',
                'style' => 'width: 7% !important;',
                'func' => function ($value) {
                    return $value->stok;
                }
            ],
            'ket' => [
                'label' => 'Keterangan',
                'style' => 'width: 39% !important;',
                'func' => function ($value) {
                    return $value->ket;
                }
            ],
            'aksi' => [
                'label' => 'Aksi',
                'style' => 'width: 14% !important;',
                'func' => function ($value) {
                    return view('components.aksi', [
                        'rempah' => $value,
                    ]);
                }
            ]
        ];
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {
        return ModelsSpice::where(function ($query) {
            if ($this->searchTerm != "") {
                $query->where('nama', 'like', '%' . $this->searchTerm . '%');
                $query->orWhere('hrg_jual', 'like', '%' . $this->searchTerm . '%');
                $query->orWhere('stok', 'like', '%' . $this->searchTerm . '%');
                $query->orWhere('ket', 'like', '%' . $this->searchTerm . '%');
            }
        })->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.spice', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    public function openSpiceModal($id = null)
    {
        if ($id) {
            $spice = ModelsSpice::find($id);
            $this->id_rempah = $spice->id;
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
        $spice = ModelsSpice::find($id);
        $this->id_rempah = $spice->id;
        $this->nama = $spice->nama;
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
    }

    public function editSpice()
    {
        $this->rules['nama'] = "required|unique:spices,nama,$this->id_rempah|max:255";
        $this->validate();

        $spice = ModelsSpice::find($this->id_rempah);
        $spice->nama = $this->nama;
        $spice->hrg_jual = $this->hrg_jual;
        $spice->stok = $this->stok;
        $spice->ket = $this->ket;
        $spice->save();

        $this->id_rempah = 0;
        $this->spiceModal = false;
    }

    public function deleteSpice()
    {
        ModelsSpice::destroy($this->id_rempah);
        $this->id_rempah = 0;
        $this->deleteSpiceModalConfirm = false;
    }
}
