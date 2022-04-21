<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Checkout extends Component
{
    public $modal;
    public $carts;
    public $countries;
    public $addresses;
    public $queryAddressModal = false;

    protected $listeners = [
        'checkoutMount' => 'mount',
        'mainAddress' => 'mainAddress',
    ];

    public function mount()
    {
        $this->countries = Country::all();
        $this->carts = collect();

        $carts = Cart::where('user_id', Auth::id())
            ->join('spices', 'carts.spice_id', '=', 'spices.id')
            ->selectRaw('carts.*, spices.nama as spice_nama, spices.hrg_jual as spice_price, spices.image as spice_image')
            ->get();

        $this->addresses = Address::where('addresses.user_id', Auth::id())
            ->selectRaw('addresses.*, countries.nicename as countries_nicename')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->get()->toArray();

        if ($carts->isNotEmpty()) {
            foreach ($carts as $cart) {
                $this->carts->push([
                    'id' => $cart->id,
                    'name' => $cart->spice_nama,
                    'url' => Str::replace(' ', '-', $cart->spice_nama),
                    'qty' => $cart->jumlah,
                    'price' => $cart->spice_price,
                    'img_src' => asset("storage/images/product/$cart->spice_image"),
                    'unit' => 'KG',
                ]);
            }
        } else {
            return redirect()->route('cart');
        }
    }

    public function mainAddress($id)
    {
        $address = Address::where('id', $id)->where('user_id', Auth::id())->first();

        if ($address) {
            $mainAddress = Address::where('primary', true)->where('user_id', Auth::id())->first();
            if ($mainAddress) {
                $mainAddress->primary = false;
                $mainAddress->save();
            }
            $address->primary = true;
            $address->save();
        }

        $this->emit('checkoutMount');
    }

    public function queryAddress()
    {
        $new = Address::create($this->modal);
        $this->emit('mainAddress', $new->id);

        $this->modal = [];
        $this->queryAddressModal = false;
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
