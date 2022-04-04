<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Order extends Component
{
    public $orders = [];
    public $review = [];
    public $detail = [];
    public $reviewModal = false;

    protected $listeners = [
        'orderMount' => 'mount',
    ];

    public function mount()
    {
        $this->orders = RequestBuy::where('user_id', Auth::id())
            ->join('statuses', 'request_buys.status_id', '=', 'statuses.id')
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama')
            ->get();

        if ($this->orders) {
            $this->orders = $this->orders->map(function ($model) {
                $model->spice_data = json_decode($model->spice_data);
                return $model;
            });
        }
    }

    public function opemModalReview($id)
    {
        dd($id);
    }

    public function opemModalDetail($id)
    {
        dd($id);
        $this->detail = RequestBuy::where('id', $id)
            ->join('statuses', 'request_buys.status_id', '=', 'statuses.id')
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama')
            ->get();
    }

    public function render()
    {
        return view('livewire.order');
    }
}
