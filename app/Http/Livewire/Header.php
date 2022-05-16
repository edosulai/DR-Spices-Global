<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class Header extends Component
{
    public $navs;
    public $carts;

    protected $listeners = [
        'headerMount' => 'mount',
    ];

    public function mount()
    {
        $this->carts = collect();

        $this->navs = [
            [
                'name' => 'Home',
                'url' => route('home'),
                'icon' => 'fas fa-home'
            ], [
                'name' => 'Our Product',
                'url' => route('home') . '/#product-exhibition',
                'icon' => 'fab fa-product-hunt'
            ], [
                'name' => 'About Us',
                'url' => route('home') . '/#about-us',
                'icon' => 'fas fa-address-card'
            ], [
                'name' => 'Contact Us',
                'url' => route('home') . '/#contact-us',
                'icon' => 'fas fa-address-book'
            ]
        ];

        $this->user_navs = [
            [
                'name' => 'My Account',
                'title' => 'Account Details',
                'icon' => 'fa fa-cog',
                'url' => route('account'),
            ]
        ];

        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::id())
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
    }

    public function render()
    {
        return view('livewire.header');
    }

    public function deleteCart($id)
    {
        Cart::where('id', $id)->delete();
        $this->emit('headerMount');
        $this->emit('checkoutMount');
    }
}
