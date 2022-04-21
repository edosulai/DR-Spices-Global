<?php

namespace App\Http\Livewire;

use App\Models\Postage as ModelsPostage;
use Livewire\Component;

class Postage extends Component
{
    public $title;
    public $modal;
    public $postageModal = false;
    public $id_postage;
    public $countries_name;
    public $cost;

    protected $listeners = [
        'editPostageModal' => 'openEditPostageModal',
    ];

    public function openEditPostageModal($id)
    {
        $postage = ModelsPostage::where('postages.id', $id)
            ->join('countries', 'postages.country_id', '=', 'countries.id')
            ->selectRaw('postages.*, countries.name as countries_name')
            ->first();

        $this->id_postage = $postage->id;
        $this->countries_name = $postage->countries_name;
        $this->cost = $postage->cost;

        $this->postageModal = true;
    }

    public function editPostage()
    {
        $postage = ModelsPostage::find($this->id_postage);
        $postage->cost = $this->cost;
        $postage->save();

        $this->postageModal = false;

        $this->emit('postageTableColumns');
    }

    public function render()
    {
        return view('livewire.postage');
    }
}
