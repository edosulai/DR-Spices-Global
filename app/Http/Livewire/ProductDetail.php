<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Spice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class ProductDetail extends Component
{
    public $spice;
    public $qty = 1;
    public $spices;
    public $reviews;

    public $feedbackCartAddModal = false;
    public $detailModal = false;

    public $modal = [];

    public function mount()
    {
        $this->spice = Spice::where('nama', 'like', '%' . Str::replace('-', ' ', request()->product) . '%')
            ->join('reviews', 'spices.id', '=', 'reviews.spice_id', 'left outer')
            ->selectRaw('spices.*, AVG(reviews.rating) as rating_avg')
            ->groupBy('spices.id')
            ->first();

        if (!$this->spice) abort(404);

        $this->reviews = Review::where('spice_id', $this->spice->id)
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->selectRaw('reviews.*, users.name as users_name')
            ->get();

        $this->spices = Spice::whereNot(fn ($query) => $query->where('spices.id', $this->spice->id))
            ->join('reviews', 'spices.id', '=', 'reviews.spice_id', 'left outer')
            ->selectRaw('spices.*, AVG(reviews.rating) as rating_avg')
            ->groupBy('spices.id')
            ->get();
    }

    public function addToCart($id = null)
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }

        $spice = Spice::find($id ?? ($this->detailModal ? $this->modal['id'] : $this->spice->id));

        if ($spice && $spice->stok > 0) {

            $this->modal['total'] = 0;

            $qty = $id ? 1 : ($this->detailModal ? $this->modal['qty'] : $this->qty);

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
        return view('livewire.product-detail');
    }
}
