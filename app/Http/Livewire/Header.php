<?php

namespace App\Http\Livewire;

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
                'url' => '#contact-us',
            ]
        ];
        $this->user_navs = [
            [
                'name' => 'My Account',
                'title' => 'Account Details',
                'icon' => 'fa fa-cog',
                'url' => '#',
            ], [
                'name' => 'Checkout',
                'title' => 'Checkout Details',
                'icon' => 'fa fa-check',
                'url' => '#',
            ], [
                'name' => 'Sign Out',
                'title' => 'Sign Out',
                'icon' => 'fas fa-sign-out-alt',
                'url' => '#',
            ]
        ];
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

    public function render()
    {
        return view('livewire.header');
    }

    public function logoutUser()
    {
        //
    }
}
