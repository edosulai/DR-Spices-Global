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
            ->selectRaw('carts.*, maggots.nama as maggot_nama, maggots.hrg_jual as maggot_price, maggot_images.image as maggot_image')
            ->join('maggots', 'carts.maggot_id', '=', 'maggots.id')
            ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
            ->get();

        if ($carts->isNotEmpty()) {
            foreach ($carts as $cart) {
                $this->carts->push([
                    'id' => $cart->id,
                    'name' => $cart->maggot_nama,
                    'url' => Str::replace(' ', '-', $cart->maggot_nama),
                    'qty' => $cart->jumlah,
                    'price' => $cart->maggot_price,
                    'img_src' => asset("storage/images/products/$cart->maggot_image"),
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
