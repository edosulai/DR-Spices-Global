<?php

namespace App\Http\Livewire;

use App\Models\Postage as ModelsPostage;
use Livewire\Component;

class Postage extends Component
{
    public $title;
    public $form = [];
    public $postageModal = false;

    protected $listeners = [
        'editPostageModal' => 'openEditPostageModal',
    ];

    protected $rules = [
        'form.cost' => 'required|integer',
    ];

    protected $validationAttributes = [
        'form.cost' => 'Biaya Pengiriman',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function openEditPostageModal($id)
    {
        $this->form = ModelsPostage::where('postages.id', $id)
            ->join('countries', 'postages.country_id', '=', 'countries.id')
            ->selectRaw('postages.*, countries.name as countries_name')
            ->first()
            ->toArray();
        $this->postageModal = true;
    }

    public function editPostage()
    {
        $this->validate();

        $postage = ModelsPostage::find($this->form['id']);
        $postage->cost = $this->form['cost'];
        $postage->save();

        $this->postageModal = false;
        $this->emit('postageTableColumns');
    }

    public function render()
    {
        return view('livewire.postage');
    }
}
