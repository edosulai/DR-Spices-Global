<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public $short;
    public $newsletter;
    public $address;
    public $phone;
    public $email;
    public $opening;
    public $navs;

    public function mount()
    {
        $this->short = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim';
        $this->newsletter = 'Sign up to our newsletter to get the latest articles, lookbooks voucher codes direct to your inbox';
        $this->address = '123 Suspendis matti, Visaosang Building VST District NY Accums, North American';
        $this->phone = '+0012-345-67890';
        $this->email = 'support@domain.com';
        $this->opening = [
            'Monday - Sunday / 08.00AM - 19.00',
            '(Except Holidays)'
        ];

        $this->navs = [
            [
                'name' => 'About Us',
                'url' => '#',
            ], [
                'name' => 'Terms of service',
                'url' => '#',
            ], [
                'name' => 'privacy Policy',
                'url' => '#',
            ], [
                'name' => 'Help',
                'url' => '#',
            ], [
                'name' => 'FAQs',
                'url' => '#',
            ]
        ];
    }

    public function render()
    {
        return view('livewire.footer');
    }
}
