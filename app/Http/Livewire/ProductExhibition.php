<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Spice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductExhibition extends Component
{
    public $status_message;
    public $spices = [];
    public $modal = [];
    public $validation_messages = [];
    public $feedbackCartAddModal = false;
    public $detailModal = false;
    public $warningModal = false;

    protected $listeners = [
        'exibitionMount' => 'mount',
    ];

    protected $rules = [
        'modal.qty' => 'required|integer|min:1',
    ];

    protected $validationAttributes = [
        'modal.qty' => 'Quantity',
    ];

    // public function updated()
    // {
    //     $this->validate($this->rules);
    // }

    public function mount($spices = null)
    {
        $this->detailModal = false;

        if ($spices) {
            $this->spices = $spices;
        } else {
            DB::statement(DB::raw("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')), @row:=0"));
            $this->spices = Spice::selectRaw('spices.*, AVG(reviews.rating) as rating_avg, spice_images.image as image')
                ->join('reviews', 'spices.id', '=', 'reviews.spice_id', 'left outer')
                ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
                ->groupBy('spices.id')
                ->get();
        }
    }

    public function addToCart($id = null)
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }

        if ($this->detailModal !== false) {
            $this->validate();
        }

        $spice = Spice::where('spices.id', $id ?? $this->modal['id'])
            ->selectRaw('spices.*, spice_images.image as image')
            ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
            ->first();

        if ($spice && $spice->stok > 0) {

            $this->modal['total'] = 0;

            $qty = $id ? 1 : $this->modal['qty'];

            Cart::updateOrCreate([
                'user_id' => Auth::id(),
                'spice_id' => $spice->id
            ], [
                'jumlah' => DB::raw('jumlah + ' . $qty),
            ]);

            $carts = Cart::where('user_id',  Auth::id())
                ->selectRaw('carts.*, spices.nama as spice_nama, spices.hrg_jual as spice_price')
                ->join('spices', 'carts.spice_id', '=', 'spices.id')
                ->get();

            $this->modal['name'] = $spice->nama;
            $this->modal['price'] = $spice->hrg_jual;
            $this->modal['unit'] = $spice->unit;
            $this->modal['rating'] = 0;
            $this->modal['qty'] = $qty;
            $this->modal['image'] = asset("/storage/images/products/$spice->image");;
            $this->modal['desc'] = $spice->ket;
            $this->modal['count'] = count($carts);
            $this->modal['instock'] = $spice->stok;

            foreach ($carts as $cart) {
                $this->modal['total'] = $this->modal['total'] + ($cart->spice_price * $cart->jumlah);
            }

            $this->detailModal = false;
            $this->feedbackCartAddModal = true;

            $this->emit('exibitionMount');
            $this->emit('headerMount');
        } else {
            $this->status_message = 'Sold Out';
            $this->validation_messages = [
                'Stock is not enough',
                'Product is not available'
            ];
            $this->warningModal = true;
        }
    }

    public function detailSpice($id)
    {
        DB::statement(DB::raw("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')), @row:=0"));
        $spice = Spice::where('spices.id', $id)
            ->selectRaw('spices.*, AVG(reviews.rating) as rating_avg, spice_images.image as image')
            ->join('reviews', 'spices.id', '=', 'reviews.spice_id', 'left outer')
            ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
            ->groupBy('spices.id')
            ->first();

        if ($spice) {

            $this->modal['total'] = 0;
            $this->modal['id'] = $spice->id;
            $this->modal['name'] = $spice->nama;
            $this->modal['price'] = $spice->hrg_jual;
            $this->modal['unit'] = $spice->unit;
            $this->modal['rating'] = $spice->rating_avg;
            $this->modal['qty'] = 1;
            $this->modal['image'] = asset("/storage/images/products/$spice->image");
            $this->modal['desc'] = $spice->ket;
            $this->modal['count'] = 0;
            $this->modal['instock'] = $spice->stok > 0 ? true : false;

            $this->detailModal = true;
        }
    }

    public function render()
    {
        return view('livewire.product-exhibition');
    }
}
