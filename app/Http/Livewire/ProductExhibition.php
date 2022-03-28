<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Spice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductExhibition extends Component
{
    public $spices = [];
    public $navs = [];
    public $feedbackCartAddModal = false;
    public $detailModal = false;

    public $modalSpiceId;
    public $modalSpiceName;
    public $modalSpicePrice;
    public $modalSpiceQty;
    public $modalSpiceImage;
    public $modalSpiceDesc;
    public $modalSpiceInStock;
    public $modalSpiceCount;
    public $modalSpiceTotal;

    public function mount()
    {
        $this->spices = Spice::all();

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

    public function render()
    {
        return view('livewire.product-exhibition');
    }

    public function addToCart($id = null)
    {
        $spice = Spice::find($id ?? $this->modalSpiceId);

        if ($spice && $spice->stok > 0) {

            $this->modalSpiceTotal = 0;

            $qty = $id ? 1 : $this->modalSpiceQty;

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
            $this->modalSpiceQty = $qty;
            $this->modalSpiceImage = $spice->image;
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
        // $this->modalSpiceId = 0;
        // $this->modalSpiceName = null;
        // $this->modalSpicePrice = 0;
        // $this->modalSpiceQty = 0;
        // $this->modalSpiceImage = null;
        // $this->modalSpiceDesc = null;
        // $this->modalSpiceInStock = false;

        $spice = Spice::find($id);

        if ($spice) {

            $this->modalSpiceId = $spice->id;
            $this->modalSpiceName = $spice->nama;
            $this->modalSpicePrice = $spice->hrg_jual;
            $this->modalSpiceQty = 1;
            $this->modalSpiceImage = $spice->image;
            $this->modalSpiceDesc = $spice->ket;
            $this->modalSpiceInStock = $spice->stok > 0 ? true : false;

            $this->detailModal = true;
        }
    }
}
