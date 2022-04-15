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
    public $requestBuyModal = false;
    public $id_requestBuy = 0;

    public $title;

    public $statuses;

    public $user_name;
    public $spice_name;
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

    public function openRequestBuyModal($id = null)
    {
        if ($id) {

            $requestBuy = ModelsRequestBuy::where('request_buys.id', $id)
                ->selectRaw("request_buys.*, users.name as user_name, JSON_EXTRACT(request_buys.spice_data, '$.nama') as spice_name, statuses.id as status_id")
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
            $this->user_name = $requestBuy->user_name;
            $this->spice_name = $requestBuy->spice_name;
            $this->status_id = $requestBuy->status_id;
            $this->jumlah = $requestBuy->jumlah;
            $this->created_at = Carbon::parse($requestBuy->created_at)->format('Y-m-d\TH:i');

            $this->requestBuyModal = true;
        }
    }

    public function editRequestBuy()
    {
        $requestBuy = ModelsRequestBuy::find($this->id_requestBuy);
        dd($requestBuy);

        Trace::firstOrCreate([
            'request_buy_id' => $requestBuy->id,
            'status_id' => $this->status_id,
        ]);

        $requestBuy->update([
            'status_id' => $this->status_id,
        ]);


        $requestBuy->status_id = $this->status_id;
        $requestBuy->save();

        $this->id_requestBuy = 0;
        $this->requestBuyModal = false;

        $this->emit('requestBuyTableColumns');
    }
}
