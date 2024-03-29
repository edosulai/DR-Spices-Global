<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Partner extends Component
{
    public $partner_logos;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->partner_logos = [
            asset('storage/images/others/icon-logo1.jpg'),
            asset('storage/images/others/icon-logo2.jpg'),
            asset('storage/images/others/icon-logo3.jpg'),
            asset('storage/images/others/icon-logo4.jpg'),
            asset('storage/images/others/icon-logo5.jpg'),
            asset('storage/images/others/icon-logo6.jpg'),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.partner');
    }
}
