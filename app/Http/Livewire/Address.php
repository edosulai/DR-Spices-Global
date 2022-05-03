<?php

namespace App\Http\Livewire;

use App\Models\Address as ModelsAddress;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Address extends Component
{
    public $headerAddressModal = '';
    public $queryAddressModal = false;
    public $deleteAddressModal = false;
    public $modal = [];
    public $addresses;
    public $countries;

    protected $listeners = [
        'addressMount' => 'mount',
        'mainAddress' => 'mainAddress',
    ];

    protected $rules = [
        'modal.recipent' => 'required|string|max:255',
        'modal.phone' => 'required|string|max:255',
        'modal.street' => 'required|string|max:255',
        'modal.other_street' => 'required|string|max:255',
        'modal.zip' => 'required|string|max:255',
        'modal.district' => 'required|string|max:255',
        'modal.city' => 'required|string|max:255',
        'modal.state' => 'required|string|max:255',
        'modal.country_id' => 'required|exists:countries,id',
    ];

    protected $validationAttributes = [
        'modal.recipent' => 'Recipent Name',
        'modal.phone' => 'Phone Number',
        'modal.street' => 'Address',
        'modal.other_street' => 'Secondary Address',
        'modal.zip' => 'Postal Code',
        'modal.district' => 'District',
        'modal.city' => 'City',
        'modal.state' => 'State',
        'modal.country_id' => 'Country',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function mount()
    {
        $this->modal = [];
        $this->queryAddressModal = false;
        $this->deleteAddressModal = false;
        $this->countries = Country::all();

        $this->addresses = ModelsAddress::where('addresses.user_id', Auth::id())
            ->selectRaw('addresses.*, countries.nicename as countries_nicename')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->get()->toArray();
    }

    public function openModalAddress($id = null)
    {
        $isExist = ModelsAddress::where('id', $id)->where('user_id', Auth::id())->first();
        if ($isExist) {
            $this->modal = $isExist->toArray();
            $this->headerAddressModal = 'Update Address';
            $this->resetErrorBag();
            $this->resetValidation();
        } else {
            if ($this->headerAddressModal != 'Add New Address') {
                $this->modal = [];
            }
            $this->headerAddressModal = 'Add New Address';
        }

        $this->queryAddressModal = true;
    }

    public function queryAddress()
    {
        $this->validate();

        if (array_key_exists('id', $this->modal)) {
            $new = ModelsAddress::where('id', $this->modal['id'])->where('user_id', Auth::id())->first();
            $new->fill($this->modal);
            $new->save();
        } else {
            $new = ModelsAddress::create($this->modal);
            if (!ModelsAddress::where('primary', true)->where('user_id', Auth::id())->first()) {
                $this->emit('mainAddress', $new->id);
            }
        }

        $this->emit('checkoutMount');
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

        $this->emit('checkoutMount');
        $this->emit('addressMount');
    }

    public function openDeleteModal($id)
    {
        $isExist = ModelsAddress::where('id', $id)->where('user_id', Auth::id())->first();
        if ($isExist) {
            $this->modal = $isExist->toArray();
            $this->deleteAddressModal = true;
        }
    }

    public function deleteAddress()
    {
        ModelsAddress::where('id', $this->modal['id'])->where('user_id', Auth::id())->delete();
        $this->emit('checkoutMount');
        $this->emit('addressMount');
    }

    public function render()
    {
        return view('livewire.address');
    }
}
