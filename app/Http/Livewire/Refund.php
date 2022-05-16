<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy;
use App\Models\Trace;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Refund extends Component
{
    public $title;
    public $refund;
    public $detailOrder;
    public $traceOrder;
    public $detailModal = false;
    public $refundModal = false;
    public $feedbackModal = false;

    protected $listeners = [
        'refundDetail' => 'openRefundDetail',
    ];

    public function openRefundDetail($id)
    {
        $this->detailOrder = RequestBuy::where('request_buys.id', $id)
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

            switch ($this->detailOrder->refund) {
                case "1":
                    $this->refund = false;
                    break;

                case "2":
                    $this->refund = true;
                    break;
            }

            $this->traceOrder = Trace::where('request_buy_id', $this->detailOrder->id)
                ->join('statuses', 'traces.status_id', '=', 'statuses.id')
                ->selectRaw('statuses.*')
                ->get();

            $this->detailModal = true;
        }
    }

    public function refundSwitch()
    {
        $requestBuy = RequestBuy::find($this->detailOrder->id);
        $requestBuy->refund = $this->refund ? "2" : "1";
        $requestBuy->save();

        $this->detailModal = false;
        $this->emit('refundTableColumns');
    }

    public function render()
    {
        return view('livewire.refund');
    }
}
