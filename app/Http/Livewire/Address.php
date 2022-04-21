<?php

namespace App\Http\Livewire;

use App\Models\Address as ModelsAddress;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Address extends Component
{
    public $addresses;
    public $headerAddressModal = '';
    public $queryAddressModal = false;
    public $deleteAddressModal = false;
    public $modal = [
        'country_id' => ''
    ];
    public $modalId;
    public $countries;

    protected $listeners = [
        'addressMount' => 'mount',
    ];

    public function mount()
    {
        $this->countries = Country::all();
        $this->addresses = ModelsAddress::where('addresses.user_id', Auth::id())
            ->selectRaw('addresses.*, countries.nicename as countries_nicename')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->get()->toArray();
    }

    public function openModalAddress($id = null)
    {
        if ($this->modalId) {
            $this->modal = [
                'country_id' => ''
            ];
            $this->modalId = null;
        }

        if ($id) {
            $this->modal = ModelsAddress::where('id', $id)->where('user_id', Auth::id())->first()->toArray();

            if ($this->modal) {
                $this->modalId = $this->modal['id'];
            }

            $this->headerAddressModal = 'Update Address';
        } else {
            $this->headerAddressModal = 'Add New Address';
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
                $this->emit('mainAddress', $new->id);
            }
        }

        $this->modal = [
            'country_id' => ''
        ];
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
