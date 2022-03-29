<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component
{
    public $logo;
    public $payment;
    public $short;
    public $newsletter;
    public $address;
    public $phone;
    public $email;
    public $opening;
    public $navs;
    public $medsoses;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->logo = asset('storage/images/home/logo.png');
        $this->payment = asset('storage/images/home/payment.png');
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

        $this->medsoses = [
            [
                'icon' => 'fab fa-facebook',
                'url' => '#',
            ],[
                'icon' => 'fab fa-twitter',
                'url' => '#',
            ],[
                'icon' => 'fab fa-instagram',
                'url' => '#',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
