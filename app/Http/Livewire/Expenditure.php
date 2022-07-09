<?php

namespace App\Http\Livewire;

use App\Models\Expenditure as ModelsExpenditure;
use App\Models\Spice;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Expenditure extends Component
{
    public $title;
    public $form = [];
    public $suppliers;
    public $spices;
    public $expenditureModal = false;
    public $deleteExpenditureModal = false;
    public $aksiExpenditureModal = 'tambahExpenditure';
    public $buttonExpenditureModal = 'Tambah';

    protected $listeners = [
        'expenditureModal' => 'openExpenditureModal',
        'deleteExpenditureModal' => 'openDeleteExpenditureModal',
    ];

    protected $rules = [
        'form.supplier_id' => 'required|exists:suppliers,id',
        'form.spice_id' => 'required|exists:spices,id',
        'form.jumlah' => 'required|integer',
    ];

    protected $validationAttributes = [
        'form.supplier_id' => 'Supplier',
        'form.spice_id' => 'Rempah',
        'form.jumlah' => 'Jumlah',
    ];

    // public function updated()
    // {
    //     $this->validate($this->rules);
    // }

    public function mount()
    {
        $this->suppliers = Supplier::all();
        $this->spices = Spice::all();
    }

    public function openExpenditureModal($id = null)
    {
        if ($id) {
            $this->form = ModelsExpenditure::where('id', $id)
                ->selectRaw("id, JSON_UNQUOTE(JSON_EXTRACT(supplier_data, '$.id')) as supplier_id, JSON_UNQUOTE(JSON_EXTRACT(spice_data, '$.id')) as spice_id, jumlah")
                ->first()
                ->toArray();
            $this->aksiExpenditureModal = 'editExpenditure';
            $this->buttonExpenditureModal = 'Edit';
        } else {
            if ($this->aksiExpenditureModal != 'tambahExpenditure') {
                $this->form = [];
            }
            $this->aksiExpenditureModal = 'tambahExpenditure';
            $this->buttonExpenditureModal = 'Tambah';
        }

        $this->expenditureModal = true;
    }

    public function openDeleteExpenditureModal($id)
    {
        $this->form = ModelsExpenditure::where('id', $id)
            ->selectRaw("id, JSON_EXTRACT(supplier_data, '$.nama') as nama, JSON_UNQUOTE(JSON_EXTRACT(spice_data, '$.id')) as spice_id, jumlah")
            ->first()
            ->toArray();
        $this->deleteExpenditureModal = true;
    }

    public function tambahExpenditure()
    {
        $this->validate();

        ModelsExpenditure::create([
            'supplier_data' => Supplier::find($this->form['supplier_id']),
            'spice_data' => Spice::where('spices.id', $this->form['spice_id'])
                ->selectRaw('spices.*, spice_images.image as image')
                ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
                ->first(),
            'jumlah' => $this->form['jumlah'],
        ]);

        Spice::where('id', $this->form['spice_id'])->increment('stok', $this->form['jumlah']);

        $this->expenditureModal = false;
        $this->emit('expenditureTableColumns');
    }

    public function editExpenditure()
    {
        $this->validate();

        $expenditure = ModelsExpenditure::find($this->form['id']);

        Spice::where('id', $this->form['spice_id'])->decrement('stok', $expenditure->jumlah);
        Spice::where('id', $this->form['spice_id'])->increment('stok', $this->form['jumlah']);

        $expenditure->supplier_data = Supplier::find($this->form['supplier_id']);
        $expenditure->spice_data = Spice::where('spices.id', $this->form['spice_id'])
            ->selectRaw('spices.*, spice_images.image as image')
            ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
            ->first();
        $expenditure->jumlah = $this->form['jumlah'];
        $expenditure->save();

        $this->expenditureModal = false;
        $this->emit('expenditureTableColumns');
    }

    public function deleteExpenditure()
    {
        Spice::where('id', $this->form['spice_id'])->decrement('stok', $this->form['jumlah']);
        ModelsExpenditure::destroy($this->form['id']);
        $this->deleteExpenditureModal = false;
        $this->emit('expenditureTableColumns');
    }

    public function render()
    {
        return view('livewire.expenditure');
    }
}
