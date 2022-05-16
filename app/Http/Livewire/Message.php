<?php

namespace App\Http\Livewire;

use App\Models\ContactUs;
use Livewire\Component;

class Message extends Component
{
    public $title;
    public $detailModal = false;
    public $modal;

    protected $listeners = [
        'messageDetail' => 'openMessageDetail',
    ];

    public function mount()
    {
        $this->modal = collect();
    }

    public function openMessageDetail($id)
    {
        $this->modal = ContactUs::find($id);
        $this->detailModal = true;
    }

    public function render()
    {
        return view('livewire.message');
    }
}
