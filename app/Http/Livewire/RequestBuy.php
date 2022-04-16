<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy as ModelsRequestBuy;
use App\Models\Status;
use App\Models\Trace;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RequestBuy extends Component
{
    public $requestModal = false;
    public $id_requestBuy = 0;

    public $title;

    public $statuses;

    public $invoice;
    public $users_name;
    public $spice_nama;
    public $status_id;
    public $jumlah;
    public $created_at;

    protected $listeners = [
        'requestBuyModal' => 'openRequestBuyModal',
    ];

    public function mount()
    {
        $this->statuses = Status::all();
    }

    public function render()
    {
        return view('livewire.request-buy');
    }

    public function openRequestBuyModal($id)
    {
        $requestBuy = ModelsRequestBuy::where('request_buys.id', $id)
            ->selectRaw("request_buys.*, users.name as users_name, JSON_EXTRACT(request_buys.spice_data, '$.nama') as spice_nama, statuses.id as status_id")
            ->join('users', 'request_buys.user_id', '=', 'users.id')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"), function ($join) {
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at');
            })->first();

        if (!$requestBuy) return;

        $this->id_requestBuy = $requestBuy->id;
        $this->invoice = $requestBuy->invoice;
        $this->users_name = $requestBuy->users_name;
        $this->spice_nama = str_replace("\"", '', $requestBuy->spice_nama);
        $this->status_id = $requestBuy->status_id;
        $this->jumlah = $requestBuy->jumlah;
        $this->created_at = Carbon::parse($requestBuy->created_at)->format('Y-m-d\TH:i');

        $this->requestModal = true;
    }

    public function editRequestBuy()
    {
        $requestBuy = ModelsRequestBuy::where('request_buys.id', $this->id_requestBuy)
            ->selectRaw("request_buys.*, statuses.created_at as statuses_created_at, traces.id as traces_id")
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->get();

        $selectedStatus = Status::find($this->status_id);

        Trace::firstOrCreate([
            'request_buy_id' => $this->id_requestBuy,
            'status_id' => $this->status_id,
        ]);

        foreach ($requestBuy as $buy) {
            if (Carbon::parse($buy->statuses_created_at)->gt(Carbon::parse($selectedStatus->created_at))) {
                Trace::destroy($buy->traces_id);
            }
        }

        $this->id_requestBuy = 0;
        $this->requestModal = false;

        $this->emit('requestBuyTableColumns');
    }
}
