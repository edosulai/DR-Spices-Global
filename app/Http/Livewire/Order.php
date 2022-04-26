<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use App\Models\Status;
use App\Models\Trace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Order extends Component
{
    public $review;
    public $traceOrder = [];
    public $detailOrder = [];
    public $orders = [];
    public $rating = [
        1 => true,
        2 => false,
        3 => false,
        4 => false,
        5 => false,
    ];
    public $reviewModal = false;
    public $detailModal = false;

    protected $listeners = [
        'orderMount' => 'mount',
    ];

    public function mount()
    {
        $this->orders = RequestBuy::where('user_id', Auth::id())
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama, STRCMP(statuses.nama, "Delivered") as need_rate')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"), function ($join) {
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at');
            })->latest()->get();
    }

    public function openModalReview($id)
    {
        $this->detailOrder = RequestBuy::where('request_buys.id', $id)->where('request_buys.user_id', Auth::id())
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"), function ($join) {
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at');
            })->first();

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

        $this->detailOrder = RequestBuy::where('request_buys.id', $id)->where('request_buys.user_id', Auth::id())
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"), function ($join) {
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at');
            })->first();

        if ($this->detailOrder) {

            $this->traceOrder = Trace::where('request_buy_id', $this->detailOrder->id)
                ->join('statuses', 'traces.status_id', '=', 'statuses.id')
                ->selectRaw('statuses.*')
                ->get();

            $this->detailModal = true;
        }
    }

    public function render()
    {
        return view('livewire.order');
    }
}
