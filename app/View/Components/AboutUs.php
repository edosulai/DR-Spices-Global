<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AboutUs extends Component
{
    public $abouts;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->abouts = [
            [
                'img_src' => asset('storage/images/others/1.jpg'),
                'title' => 'WHO WE ARE',
                'desc' => [
                    'We are from the global DR Spices Company or better known as an international export company, and we provide a wide variety of spices that are ready to be exported to your country.'
                ]
            ],[
                'img_src' => asset('storage/images/others/2.jpg'),
                'title' => 'WHAT WE DO',
                'desc' => [
                    'We from the global DR Spices Company export spices to your country, to launch new opportunities and expand the domestic market, investment, and foreign exchange, as well as strengthen relations between countries.',
                ]
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.about-us');
    }
}
