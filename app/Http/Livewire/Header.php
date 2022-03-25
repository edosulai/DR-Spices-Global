<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public $id_user = 0;

    public $user;
    public $navs;

    public $carts;
    public $total;

    public function mount()
    {
        $this->user = Auth::user();
        $this->navs = [
            [
                'name' => 'Home',
                'url' => route('home'),
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
            $carts = Cart::join('users', 'carts.user_id', '=', 'users.id')
            ->join('spices', 'carts.spice_id', '=', 'spices.id')
            ->selectRaw('carts.*, spices.nama as spice_name, spices.harga as spice_price, users.name as user_name');

            $this->carts = [
                [
                    'name' => 'Nature Close Tea',
                    'url' => '#',
                    'qty' => 2,
                    'price' => 12000,
                    'img_src' => asset('storage/images/product/4.jpg'),
                ],[
                    'name' => 'Pink Wave Cup',
                    'url' => '#',
                    'qty' => 2,
                    'price' => 12000,
                    'img_src' => asset('storage/images/product/5.jpg'),
                ]
            ];
            $this->total = 24000;
        }
    }

    public function render()
    {
        return view('livewire.header');
    }

    public function logoutUser()
    {
        //
    }
}
