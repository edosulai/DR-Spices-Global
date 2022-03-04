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
    public $title;

    public $nama = "hehehe";
    public $hrg_jual;
    public $stok;
    public $ket;

    protected $rules = [
        'nama' => 'required|unique:spices|max:255',
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
                'func' => function($value) {
                    return $value;
                }
            ],
            'nama' => [
                'label' => 'Nama',
                'style' => 'width: 15% !important;',
                'func' => function($value) {
                    return $value;
                }
            ],
            'hrg_jual' => [
                'label' => 'Harga Jual',
                'style' => 'width: 10% !important;',
                'func' => function($value) {
                    return "Rp. " .number_format($value, 0, ',', '.');
                }
            ],
            'stok' => [
                'label' => 'Stok',
                'style' => 'width: 7% !important;',
                'func' => function($value) {
                    return $value;
                }
            ],
            'ket' => [
                'label' => 'Keterangan',
                'style' => 'width: 41% !important;',
                'func' => function($value) {
                    return $value;
                }
            ],
            'aksi' => [
                'label' => 'Aksi',
                'style' => 'width: 15% !important;',
                'func' => function($value) {
                    return view('components.aksi');
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

    public function openSpiceModal()
    {
        $this->spiceModal = true;
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

        $this->nama = '';
        $this->hrg_jual = '';
        $this->stok = '';
        $this->ket = '';

        $this->spiceModal = false;
    }
}
