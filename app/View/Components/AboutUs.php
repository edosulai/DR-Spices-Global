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
                'img_src' => asset('storage/images/other/1.jpg'),
                'title' => 'WHO WE ARE',
                'desc' => [
                    'Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis biben dum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.',
                    'Proin gravida nibh vel velit auctor aliquet. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.'
                ]
            ],[
                'img_src' => asset('storage/images/other/2.jpg'),
                'title' => 'WHAT WE DO',
                'desc' => [
                    'Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis biben dum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.',
                    'Proin gravida nibh vel velit auctor aliquet. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.'
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
