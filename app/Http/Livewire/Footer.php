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
        $this->short = 'We spice up your life the best we can, We bring you the finest and the purest and the best natural taste enhancers because we care for you.';
        $this->newsletter = 'Sign up to our newsletter to get the latest articles, lookbooks voucher codes direct to your inbox';
        $this->address = 'Jl. Raya Bukittingi - Payakumbuh KM.13, Jorong Baso, Kab. Agam, Sumatera Barat, 26192';
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
