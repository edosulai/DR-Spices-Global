<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RequestBuy extends Component
{
    public $title;
    
    public function render()
    {
        return view('livewire.request-buy');
    }
}
