<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Cart extends Component
{
    public $carts;

    protected $listeners = [
        'cartMount' => 'mount',
    ];

    public function mount()
    {
        $this->carts = collect();

        $carts = ModelsCart::where('user_id', Auth::id())
            ->join('spices', 'carts.spice_id', '=', 'spices.id')
            ->selectRaw('carts.*, spices.nama as spice_name, spices.hrg_jual as spice_price, spices.image as spice_image')
            ->get();

        if ($carts->isNotEmpty()) {
            foreach ($carts as $cart) {
                $this->carts->push([
                    'id' => $cart->id,
                    'name' => $cart->spice_name,
                    'url' => Str::replace(' ', '-', $cart->spice_name),
                    'qty' => $cart->jumlah,
                    'price' => $cart->spice_price,
                    'img_src' => asset("storage/images/product/$cart->spice_image"),
                    'unit' => 'KG',
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function deleteCart($id)
    {
        ModelsCart::where('id', $id)->delete();
        $this->emit('headerMount');
        $this->emit('cartMount');
    }
}
