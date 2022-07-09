<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class Cart extends Component
{
    public $carts;

    protected $listeners = [
        'cartMount' => 'mount',
    ];

    protected $rules = [
        'carts.*.qty' => 'required|integer|min:1',
    ];

    protected $validationAttributes = [
        'carts.*.qty' => 'Quantity',
    ];

    // public function updated()
    // {
    //     $this->validate($this->rules);
    // }

    public function mount()
    {
        $this->carts = collect();

        $carts = ModelsCart::where('user_id', Auth::id())
            ->selectRaw('carts.*, spices.nama as spice_nama, spices.hrg_jual as spice_price, spice_images.image as spice_image')
            ->join('spices', 'carts.spice_id', '=', 'spices.id')
            ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
            ->get();

        if ($carts->isNotEmpty()) {
            foreach ($carts as $cart) {
                $this->carts->push([
                    'id' => $cart->id,
                    'name' => $cart->spice_nama,
                    'url' => Str::replace(' ', '-', $cart->spice_nama),
                    'qty' => $cart->jumlah,
                    'price' => $cart->spice_price,
                    'img_src' => asset("storage/images/products/$cart->spice_image"),
                    'unit' => 'KG',
                ]);
            }
        }
    }

    public function proceedCheckout()
    {
        $this->validate();

        foreach ($this->carts as $cart) {
            $oldCart = ModelsCart::where('user_id', Auth::id())->where('id', $cart['id'])->first();
            $oldCart->jumlah = $cart['qty'];
            $oldCart->save();
        }

        $this->redirectRoute('checkout');
    }

    public function deleteCart($id)
    {
        ModelsCart::where('id', $id)->delete();
        $this->emit('headerMount');
        $this->emit('cartMount');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
