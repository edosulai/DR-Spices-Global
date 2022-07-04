<?php

namespace App\Http\Livewire;

use App\Models\Expenditure as ModelsExpenditure;
use App\Models\Maggot;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Expenditure extends Component
{
    public $title;
    public $form = [];
    public $suppliers;
    public $maggots;
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
        'form.maggot_id' => 'required|exists:maggots,id',
        'form.jumlah' => 'required|integer',
    ];

    protected $validationAttributes = [
        'form.supplier_id' => 'Supplier',
        'form.maggot_id' => 'Maggot',
        'form.jumlah' => 'Jumlah',
    ];

    // public function updated()
    // {
    //     $this->validate($this->rules);
    // }

    public function mount()
    {
        $this->suppliers = Supplier::all();
        $this->maggots = Maggot::all();
    }

    public function openExpenditureModal($id = null)
    {
        if ($id) {
            $this->form = ModelsExpenditure::where('id', $id)
                ->selectRaw("id, JSON_UNQUOTE(JSON_EXTRACT(supplier_data, '$.id')) as supplier_id, JSON_UNQUOTE(JSON_EXTRACT(maggot_data, '$.id')) as maggot_id, jumlah")
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
            ->selectRaw("id, JSON_EXTRACT(supplier_data, '$.nama') as nama, JSON_UNQUOTE(JSON_EXTRACT(maggot_data, '$.id')) as maggot_id, jumlah")
            ->first()
            ->toArray();
        $this->deleteExpenditureModal = true;
    }

    public function tambahExpenditure()
    {
        $this->validate();

        ModelsExpenditure::create([
            'supplier_data' => Supplier::find($this->form['supplier_id']),
            'maggot_data' => Maggot::where('maggots.id', $this->form['maggot_id'])
                ->selectRaw('maggots.*, maggot_images.image as image')
                ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
                ->first(),
            'jumlah' => $this->form['jumlah'],
        ]);

        Maggot::where('id', $this->form['maggot_id'])->increment('stok', $this->form['jumlah']);

        $this->expenditureModal = false;
        $this->emit('expenditureTableColumns');
    }

    public function editExpenditure()
    {
        $this->validate();

        $expenditure = ModelsExpenditure::find($this->form['id']);

        Maggot::where('id', $this->form['maggot_id'])->decrement('stok', $expenditure->jumlah);
        Maggot::where('id', $this->form['maggot_id'])->increment('stok', $this->form['jumlah']);

        $expenditure->supplier_data = Supplier::find($this->form['supplier_id']);
        $expenditure->maggot_data = Maggot::where('maggots.id', $this->form['maggot_id'])
            ->selectRaw('maggots.*, maggot_images.image as image')
            ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
            ->first();
        $expenditure->jumlah = $this->form['jumlah'];
        $expenditure->save();

        $this->expenditureModal = false;
        $this->emit('expenditureTableColumns');
    }

    public function deleteExpenditure()
    {
        Maggot::where('id', $this->form['maggot_id'])->decrement('stok', $this->form['jumlah']);
        ModelsExpenditure::destroy($this->form['id']);
        $this->deleteExpenditureModal = false;
        $this->emit('expenditureTableColumns');
    }

    public function render()
    {
        return view('livewire.expenditure');
    }
}
