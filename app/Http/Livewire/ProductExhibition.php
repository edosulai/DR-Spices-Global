<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Maggot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductExhibition extends Component
{
    public $status_message;
    public $maggots = [];
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

    public function mount($maggots = null)
    {
        $this->detailModal = false;

        if ($maggots) {
            $this->maggots = $maggots;
        } else {
            DB::statement(DB::raw("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')), @row:=0"));
            $this->maggots = Maggot::selectRaw('maggots.*, AVG(reviews.rating) as rating_avg, maggot_images.image as image')
                ->join('reviews', 'maggots.id', '=', 'reviews.maggot_id', 'left outer')
                ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
                ->groupBy('maggots.id')
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

        $maggot = Maggot::where('maggots.id', $id ?? $this->modal['id'])
            ->selectRaw('maggots.*, maggot_images.image as image')
            ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
            ->first();

        if ($maggot && $maggot->stok > 0) {

            $this->modal['total'] = 0;

            $qty = $id ? 1 : $this->modal['qty'];

            Cart::updateOrCreate([
                'user_id' => Auth::id(),
                'maggot_id' => $maggot->id
            ], [
                'jumlah' => DB::raw('jumlah + ' . $qty),
            ]);

            $carts = Cart::where('user_id',  Auth::id())
                ->selectRaw('carts.*, maggots.nama as maggot_nama, maggots.hrg_jual as maggot_price')
                ->join('maggots', 'carts.maggot_id', '=', 'maggots.id')
                ->get();

            $this->modal['name'] = $maggot->nama;
            $this->modal['price'] = $maggot->hrg_jual;
            $this->modal['unit'] = $maggot->unit;
            $this->modal['rating'] = 0;
            $this->modal['qty'] = $qty;
            $this->modal['image'] = asset("/storage/images/products/$maggot->image");;
            $this->modal['desc'] = $maggot->ket;
            $this->modal['count'] = count($carts);
            $this->modal['instock'] = $maggot->stok;

            foreach ($carts as $cart) {
                $this->modal['total'] = $this->modal['total'] + ($cart->maggot_price * $cart->jumlah);
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

    public function detailMaggot($id)
    {
        DB::statement(DB::raw("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')), @row:=0"));
        $maggot = Maggot::where('maggots.id', $id)
            ->selectRaw('maggots.*, AVG(reviews.rating) as rating_avg, maggot_images.image as image')
            ->join('reviews', 'maggots.id', '=', 'reviews.maggot_id', 'left outer')
            ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
            ->groupBy('maggots.id')
            ->first();

        if ($maggot) {

            $this->modal['total'] = 0;
            $this->modal['id'] = $maggot->id;
            $this->modal['name'] = $maggot->nama;
            $this->modal['price'] = $maggot->hrg_jual;
            $this->modal['unit'] = $maggot->unit;
            $this->modal['rating'] = $maggot->rating_avg;
            $this->modal['qty'] = 1;
            $this->modal['image'] = asset("/storage/images/products/$maggot->image");
            $this->modal['desc'] = $maggot->ket;
            $this->modal['count'] = 0;
            $this->modal['instock'] = $maggot->stok > 0 ? true : false;

            $this->detailModal = true;
        }
    }

    public function render()
    {
        return view('livewire.product-exhibition');
    }
}
