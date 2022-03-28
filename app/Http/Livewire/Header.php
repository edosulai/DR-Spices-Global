<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Header extends Component
{
    public $user;
    public $navs = [];
    public $carts = [];
    public $total = 0;
    public $cart_exist = false;

    protected $listeners = [
        'headerMount' => 'mount',
    ];

    public function mount()
    {
        $this->carts = [];
        $this->cart_exist = false;
        $this->total = 0;

        $this->user = Auth::user();

        $this->navs = [
            [
                'name' => 'Home',
                'url' => route('home'),
            ], [
                'name' => 'Our Product',
                'url' => '#product-exhibition',
            ], [
                'name' => 'About Us',
                'url' => '#about-us',
            ], [
                'name' => 'Contact Us',
                'url' => route('contact'),
            ]
        ];

        $this->user_navs = [
            [
                'name' => 'My Account',
                'title' => 'Account Details',
                'icon' => 'fa fa-cog',
                'url' => route('account'),
            ], [
                'name' => 'Checkout',
                'title' => 'Checkout Details',
                'icon' => 'fa fa-check',
                'url' => route('checkout'),
            ]
        ];

        if ($this->user) {
            $carts = Cart::where('user_id', $this->user->id)
                ->join('spices', 'carts.spice_id', '=', 'spices.id')
                ->selectRaw('carts.*, spices.nama as spice_name, spices.hrg_jual as spice_price, spices.image as spice_image')
                ->get();

            if (count($carts) > 0) {

                foreach ($carts as $cart) {
                    $this->carts[] = [
                        'id' => $cart->id,
                        'name' => $cart->spice_name,
                        'url' => Str::replace(' ', '-', $cart->spice_name),
                        'qty' => $cart->jumlah,
                        'price' => $cart->spice_price,
                        'img_src' => asset("storage/images/product/$cart->spice_image"),
                    ];

                    $this->total = $this->total + ($cart->jumlah * $cart->spice_price);
                }

                $this->cart_exist = true;

                return;
            }
        }
    }

    public function render()
    {
        return view('livewire.header');
    }

    public function deleteCart($id)
    {
        Cart::where('id', $id)->delete();
        $this->emit('headerMount');
    }
}
