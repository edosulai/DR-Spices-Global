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

    public $modalSpiceId;
    public $modalSpiceName;
    public $modalSpiceUnit;
    public $modalSpiceRating;
    public $modalSpicePrice;
    public $modalSpiceQty;
    public $modalSpiceImage;
    public $modalSpiceDesc;
    public $modalSpiceInStock;
    public $modalSpiceCount;
    public $modalSpiceTotal;

    public function mount()
    {
        $this->spice = Spice::where('nama', 'like', '%' . Str::replace('-', ' ', request()->product) . '%')
            ->join('reviews', 'spices.id', '=', 'reviews.spice_id')
            ->selectRaw('spices.*, AVG(reviews.rating) as review_avg')
            ->groupBy('spices.id')
            ->first();

        if (!$this->spice) abort(404);

        $this->reviews = Review::where('spice_id', $this->spice->id)
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->selectRaw('reviews.*, users.name as user_name')
            ->get();

        $this->spices = Spice::whereNot(fn ($query) => $query->where('spice_id', $this->spice->id))
            ->join('reviews', 'spices.id', '=', 'reviews.spice_id')
            ->selectRaw('spices.*, AVG(reviews.rating) as review_avg')
            ->groupBy('spices.id')
            ->get();
    }

    public function render()
    {
        return view('livewire.product-detail');
    }

    public function addToCart($id = null)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $spice = Spice::find($id ?? ($this->detailModal ? $this->modalSpiceId : $this->spice->id));

        if ($spice && $spice->stok > 0) {

            $this->modalSpiceTotal = 0;

            $qty = $id ? 1 : ($this->detailModal ? $this->modalSpiceQty : $this->qty);

            Cart::updateOrCreate([
                'user_id' => Auth::id(),
                'spice_id' => $spice->id
            ], [
                'jumlah' => DB::raw('jumlah + ' . $qty),
            ]);

            $carts = Cart::where('user_id',  Auth::id())
                ->join('spices', 'carts.spice_id', '=', 'spices.id')
                ->selectRaw('carts.*, spices.nama as spice_name, spices.hrg_jual as spice_price, spices.image as spice_image')
                ->get();

            $this->modalSpiceName = $spice->nama;
            $this->modalSpicePrice = $spice->hrg_jual;
            $this->modalSpiceUnit = $spice->unit;
            $this->modalSpiceQty = $qty;
            $this->modalSpiceImage = asset("/storage/images/product/$spice->image");;
            $this->modalSpiceDesc = $spice->ket;
            $this->modalSpiceCount = count($carts);
            $this->modalSpiceInStock = $spice->stok;

            foreach ($carts as $cart) {
                $this->modalSpiceTotal = $this->modalSpiceTotal + ($cart->spice_price * $cart->jumlah);
            }

            $this->detailModal = false;
            $this->feedbackCartAddModal = true;

            $this->emit('headerMount');
        }
    }

    public function detailSpice($id)
    {
        $spice = Spice::where('spices.id', $id)
            ->join('reviews', 'spices.id', '=', 'reviews.spice_id')
            ->selectRaw('spices.*, AVG(reviews.rating) as review_avg')
            ->groupBy('spices.id')
            ->first();

        if ($spice) {

            $this->modalSpiceId = $spice->id;
            $this->modalSpiceName = $spice->nama;
            $this->modalSpicePrice = $spice->hrg_jual;
            $this->modalSpiceUnit = $spice->unit;
            $this->modalSpiceRating = $spice->review_avg;
            $this->modalSpiceQty = 1;
            $this->modalSpiceImage = asset("/storage/images/product/$spice->image");
            $this->modalSpiceDesc = $spice->ket;
            $this->modalSpiceInStock = $spice->stok > 0 ? true : false;

            $this->detailModal = true;
        }
    }
}