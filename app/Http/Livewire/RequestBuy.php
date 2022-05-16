<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy as ModelsRequestBuy;
use App\Models\Status;
use App\Models\Trace;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RequestBuy extends Component
{
    public $title;
    public $statuses;
    public $detailModal = false;
    public $status_id = '';
    public $traceOrder = [];
    public $detailOrder;

    protected $listeners = [
        'requestBuyDetail' => 'openRequestBuyDetail',
    ];

    protected $rules = [
        'status_id' => 'required|exists:statuses,id',
    ];

    protected $validationAttributes = [
        'status_id' => 'Status',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function mount()
    {
        $this->statuses = Status::whereNotIn('nama', ['Order Placed', 'Canceled'])->get();
    }

    public function openRequestBuyDetail($id)
    {
        $this->detailOrder = ModelsRequestBuy::where('request_buys.id', $id)
            ->selectRaw('request_buys.*, statuses.nama as statuses_nama, statuses.id as status_id')
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

            $this->status_id = $this->detailOrder->status_id;

            $this->traceOrder = Trace::where('request_buy_id', $this->detailOrder->id)
                ->join('statuses', 'traces.status_id', '=', 'statuses.id')
                ->selectRaw('statuses.*')
                ->get();

            $this->detailModal = true;
        }
    }

    public function editRequestBuy()
    {
        $requestBuy = ModelsRequestBuy::where('request_buys.id', $this->detailOrder->id)
            ->selectRaw("statuses.created_at as statuses_created_at, traces.id as traces_id")
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->orderBy('traces.created_at', 'desc')
            ->get();

        $status = Status::find($this->status_id);

        Trace::firstOrCreate([
            'request_buy_id' => $this->detailOrder->id,
            'status_id' =>  $this->status_id,
        ]);

        foreach ($requestBuy as $buy) {
            if (Carbon::parse($buy->statuses_created_at)->gt(Carbon::parse($status->created_at))) {
                Trace::destroy($buy->traces_id);
            }
        }

        $this->detailModal = false;
        $this->emit('requestBuyTableColumns');
    }

    public function render()
    {
        return view('livewire.request-buy');
    }
}
