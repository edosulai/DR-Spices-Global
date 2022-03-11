<?php

namespace App\Http\Livewire;

use App\Models\RequestBuy as ModelsRequestBuy;
use App\Models\Status;
use Illuminate\Support\Carbon;
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

    public $rules = [
        'status_id' => 'required|exists:statuses,id',
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
        if (is_int($id)) {
            $requestBuy = ModelsRequestBuy::where('request_buys.id', $id)
                ->join('users', 'request_buys.user_id', '=', 'users.id')
                ->join('spices', 'request_buys.spice_id', '=', 'spices.id')
                ->selectRaw('request_buys.*, users.name as user_name, spices.nama as spice_name')
                ->get()->first();

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
        $this->validate();

        $requestBuy = ModelsRequestBuy::find($this->id_requestBuy);
        $requestBuy->status_id = $this->status_id;
        $requestBuy->save();

        $this->id_requestBuy = 0;
        $this->requestBuyModal = false;

        $this->emit('requestBuyTableColumns');
    }
}
