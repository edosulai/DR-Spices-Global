<?php

namespace App\Http\Livewire;

use App\Models\Address as ModelsAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Address extends Component
{
    public $addresses = [];
    public $queryAddressModal = false;
    public $deleteAddressModal = false;
    public $modal;
    public $modalId;

    protected $listeners = [
        'addressMount' => 'mount',
    ];

    public function mount()
    {
        $this->addresses = ModelsAddress::where('user_id', Auth::id())->get();
    }

    public function openModalAddress($id = null)
    {
        if ($this->modalId) {
            $this->modal = [];
            $this->modalId = null;
        }

        if ($id) {
            $this->modal = ModelsAddress::where('id', $id)->where('user_id', Auth::id())->first()->toArray();
            if ($this->modal) {
                $this->modalId = $this->modal['id'];
            }
        }

        $this->queryAddressModal = true;
    }

    public function queryAddress()
    {
        if ($this->modalId) {
            $new = ModelsAddress::where('id', $this->modalId)->where('user_id', Auth::id())->first();
            $new->fill($this->modal);
            $new->save();
        } else {
            $new = ModelsAddress::create($this->modal);
            if (!ModelsAddress::where('primary', true)->where('user_id', Auth::id())->first()) {
                $this->mainAddress($new->id);
            }
        }

        $this->modal = [];
        $this->queryAddressModal = false;
        $this->emit('addressMount');
    }

    public function mainAddress($id)
    {
        $address = ModelsAddress::where('id', $id)->where('user_id', Auth::id())->first();
        
        if ($address) {
            $mainAddress = ModelsAddress::where('primary', true)->where('user_id', Auth::id())->first();
            if ($mainAddress) {
                $mainAddress->primary = false;
                $mainAddress->save();
            }
            $address->primary = true;
            $address->save();
        }

        $this->emit('addressMount');
    }

    public function openConfirmModal($id)
    {
        $this->modalId = $id;
        $this->deleteAddressModal = true;
    }

    public function deleteAddress()
    {
        ModelsAddress::where('id', $this->modalId)->where('user_id', Auth::id())->delete();
        $this->deleteAddressModal = false;
        $this->emit('addressMount');
    }

    public function render()
    {
        return view('livewire.address');
    }
}
