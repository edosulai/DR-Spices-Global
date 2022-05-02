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
    public $title;
    public $statuses;
    public $requestModal = false;
    public $form = [];

    protected $listeners = [
        'requestBuyModal' => 'openRequestBuyModal',
    ];

    protected $rules = [
        'form.status_id' => 'required|exists:statuses,id',
    ];

    protected $validationAttributes = [
        'form.status_id' => 'Status',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function mount()
    {
        $this->statuses = Status::all();
    }

    public function openRequestBuyModal($id)
    {
        $this->form = ModelsRequestBuy::where('request_buys.id', $id)
            ->selectRaw("
                request_buys.*,
                users.name as users_name,
                REPLACE(JSON_EXTRACT(request_buys.spice_data, '$[*].nama'), '\"', '') as spice_nama,
                JSON_EXTRACT(request_buys.spice_data, '$[*].jumlah') as jumlah,
                statuses.id as status_id
            ")
            ->join('users', 'request_buys.user_id', '=', 'users.id')
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->join(
                DB::raw("(select traces.request_buy_id, MAX(traces.created_at) as traces_created_at from `request_buys` inner join `traces` on `request_buys`.`id` = `traces`.`request_buy_id` group by traces.request_buy_id) join_traces"),
                fn ($join) =>
                $join
                    ->on('traces.request_buy_id', '=', 'join_traces.request_buy_id')
                    ->on('traces.created_at', '=', 'join_traces.traces_created_at')
            )
            ->first()
            ->toArray();

        $this->form['created_at'] = Carbon::parse($this->form['created_at'])->format('Y-m-d\TH:i');
        $this->requestModal = true;
    }

    public function editRequestBuy()
    {
        $requestBuy = ModelsRequestBuy::where('request_buys.id', $this->form['id'])
            ->selectRaw("statuses.created_at as statuses_created_at, traces.id as traces_id")
            ->join('traces', 'request_buys.id', '=', 'traces.request_buy_id')
            ->join('statuses', 'traces.status_id', '=', 'statuses.id')
            ->orderBy('traces.created_at', 'desc')
            ->get();

        $status = Status::find($this->form['status_id']);

        Trace::firstOrCreate([
            'request_buy_id' => $this->form['id'],
            'status_id' => $this->form['status_id'],
        ]);

        foreach ($requestBuy as $buy) {
            if (Carbon::parse($buy->statuses_created_at)->gt(Carbon::parse($status->created_at))) {
                Trace::destroy($buy->traces_id);
            }
        }

        $this->requestModal = false;
        $this->emit('requestBuyTableColumns');
    }

    public function render()
    {
        return view('livewire.request-buy');
    }
}
