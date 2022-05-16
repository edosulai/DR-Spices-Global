<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use App\Models\Review;
use App\Models\Status;
use App\Models\Trace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $reviews = [];
    public $traceOrder = [];
    public $ratings = [];
    public $detailOrder;
    public $reviewModal = false;
    public $detailModal = false;
    public $cancelModal = false;
    public $feedbackModal = false;

    protected $listeners = [
        'orderRender' => 'render',
    ];

    public function openModalReview($id)
    {
        $this->ratings = [];
        $this->reviews = [];

        $this->detailOrder = RequestBuy::where('request_buys.id', $id)->where('request_buys.user_id', Auth::id())
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            // ->join('reviews', 'request_buys.id', '=', 'reviews.request_buy_id', 'left outer')
            ->join(
                DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"),
                fn ($join) =>
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at')
            )->first();

        if ($this->detailOrder) {

            $review = Review::where('request_buy_id', $id)->where('user_id', Auth::id())->get();

            if ($review) {
                $review->each(function ($item) {
                    $this->ratings[$item->spice_id] = $item->rating;
                    $this->reviews[$item->spice_id] = $item->summary;
                });
            } else {
                foreach ($this->detailOrder->spice_data as $spice) {
                    $this->ratings[$spice['id']] = 5;
                    $this->reviews[$spice['id']] = ' ';
                }
            }

            $this->reviewModal = true;
        }
    }

    public function submitReview()
    {
        foreach ($this->detailOrder->spice_data as $spice) {
            Review::create([
                'user_id' => Auth::id(),
                'spice_id' => $spice['id'],
                'request_buy_id' => $this->detailOrder->id,
                'summary' => $this->reviews[$spice['id']],
                'rating' => $this->ratings[$spice['id']],
            ]);
        }

        Trace::create([
            'request_buy_id' => $this->detailOrder->id,
            'status_id' => Status::where('nama', 'Rated')->first()->id,
        ]);

        $this->reviewModal = false;
    }

    public function openModalDetail($id)
    {
        $this->detailOrder = RequestBuy::where('request_buys.id', $id)->where('request_buys.user_id', Auth::id())
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(
                DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"),
                fn ($join) =>
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at')
            )->first();

        if ($this->detailOrder) {

            $this->traceOrder = Trace::where('request_buy_id', $this->detailOrder->id)
                ->join('statuses', 'traces.status_id', '=', 'statuses.id')
                ->selectRaw('statuses.*')
                ->get();

            $this->detailModal = true;
        }
    }

    public function cancelOrder()
    {
        $cancelStatus = Status::where('nama', 'Canceled')->first();

        $this->detailOrder->update([
            'status_id' => $cancelStatus->id,
        ]);

        Trace::create([
            'request_buy_id' => $this->detailOrder->id,
            'status_id' => $cancelStatus->id,
        ]);

        $this->cancelModal = false;
        $this->feedbackModal = true;
        $this->emit('orderRender');
    }

    public function render()
    {
        return view('livewire.order', [
            'orders' => RequestBuy::where('user_id', Auth::id())
                ->selectRaw('request_buys.*, statuses.nama as statuses_nama')
                ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
                ->join('statuses', 'traces.status_id', '=', 'statuses.id')
                ->join(
                    DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"),
                    fn ($join) =>
                    $join
                        ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                        ->on('traces.created_at', '=', 'join_traces.traces_created_at')
                )
                ->latest()
                ->paginate(10)
        ]);
    }
}
