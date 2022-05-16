<?php

namespace App\Http\Livewire;

use App\Models\NewsSub;
use Livewire\Component;

class Footer extends Component
{
    public $logo;
    public $payments;
    public $short;
    public $newsletter;
    public $address;
    public $phone;
    public $email;
    public $opening;
    public $navs;
    public $medsoses;

    public $form = [];
    public $feedbackModal = false;

    protected $rules = [
        'form.email' => 'required|email',
    ];

    protected $validationAttributes = [
        'form.email' => 'Email Address'
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function mount()
    {
        $this->logo = asset('storage/images/others/logo.png');
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

        $this->payments = [
            asset('storage/images/others/visa.png'),
            asset('storage/images/others/mastercard.png'),
            asset('storage/images/others/jcb.png'),
            asset('storage/images/others/americanexpress.png'),
        ];
    }

    public function send()
    {
        $this->validate();
        NewsSub::firstOrCreate($this->form);
        $this->feedbackModal = true;
    }

    public function render()
    {
        return view('livewire.footer');
    }
}
