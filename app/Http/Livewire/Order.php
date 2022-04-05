<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Order extends Component
{
    public $review;
    public $detailOrder = [];
    public $orders = [];
    public $rating = [
        1 => true,
        2 => false,
        3 => false,
        4 => false,
        5 => false,
    ];
    public $statuses = [];
    public $reviewModal = false;
    public $detailModal = false;

    protected $listeners = [
        'orderMount' => 'mount',
    ];

    public function mount()
    {
        $this->orders = RequestBuy::where('user_id', Auth::id())
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->selectRaw('request_buys.*, MAX(traces.id) as traces_id, MAX(statuses.nama) as statuses_nama')
            ->groupBy('request_buys.id')
            ->latest()
            ->get();

        $this->statuses = Status::latest()->get();
    }

    public function openModalReview($id)
    {
        $this->detailOrder = RequestBuy::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($this->detailOrder) {
            $this->reviewModal = true;
        }
    }

    public function submitReview()
    {
        dd($this->rating);
    }

    public function openModalDetail($id)
    {

        $this->detailOrder = RequestBuy::where('request_buys.id', $id)
            ->where('request_buys.user_id', Auth::id())
            ->join('statuses', 'request_buys.status_id', '=', 'statuses.id')
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama')
            ->first();

        if ($this->detailOrder) {
            $this->detailModal = true;
        }
    }

    public function render()
    {
        return view('livewire.order');
    }
}
