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
    public $validation_messages = [];
    public $spices = [];
    public $navs = [];
    public $modal = [];
    public $feedbackCartAddModal = false;
    public $detailModal = false;
    public $warningModal = false;

    public function mount()
    {
        $this->spices = Spice::join('reviews', 'spices.id', '=', 'reviews.spice_id', 'left outer')
            ->selectRaw('spices.*, AVG(reviews.rating) as rating_avg')
            ->groupBy('spices.id')
            ->get();

        $this->navs = [
            [
                'name' => 'Home',
                'url' => route('home'),
            ], [
                'name' => 'Contact Us',
                'url' => route('contact'),
            ]
        ];
    }

    public function addToCart($id = null)
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }

        $spice = Spice::find($id ?? $this->modal['id']);

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
                ->join('spices', 'carts.spice_id', '=', 'spices.id')
                ->selectRaw('carts.*, spices.nama as spice_nama, spices.hrg_jual as spice_price, spices.image as spice_image')
                ->get();

            $this->modal['name'] = $spice->nama;
            $this->modal['price'] = $spice->hrg_jual;
            $this->modal['unit'] = $spice->unit;
            $this->modal['rating'] = 0;
            $this->modal['qty'] = $qty;
            $this->modal['image'] = asset("/storage/images/product/$spice->image");;
            $this->modal['desc'] = $spice->ket;
            $this->modal['count'] = count($carts);
            $this->modal['instock'] = $spice->stok;

            foreach ($carts as $cart) {
                $this->modal['total'] = $this->modal['total'] + ($cart->spice_price * $cart->jumlah);
            }

            $this->detailModal = false;
            $this->feedbackCartAddModal = true;

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
        $spice = Spice::where('spices.id', $id)
            ->join('reviews', 'spices.id', '=', 'reviews.spice_id', 'left outer')
            ->selectRaw('spices.*, AVG(reviews.rating) as rating_avg')
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
            $this->modal['image'] = asset("/storage/images/product/$spice->image");
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
