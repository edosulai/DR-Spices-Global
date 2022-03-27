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

    public $modalCartAddName;
    public $modalCartAddPrice;
    public $modalCartAddQty;
    public $modalCartAddImage;
    public $modalCartAddCount;
    public $modalCartAddTotal;

    public function mount()
    {
        $this->spices = Spice::where('stok', '>', 0)->get();

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

    public function addToCart($id)
    {
        $spice = Spice::find($id);

        if ($spice && $spice->stok > 0) {

            $this->modalCartAddTotal = 0;

            Cart::updateOrCreate([
                'user_id' => Auth::id(),
                'spice_id' => $id
            ], [
                'jumlah' => DB::raw('jumlah + 1'),
            ]);

            $carts = Cart::where('user_id',  Auth::id())
                ->join('spices', 'carts.spice_id', '=', 'spices.id')
                ->selectRaw('carts.*, spices.nama as spice_name, spices.hrg_jual as spice_price, spices.image as spice_image')
                ->get();

            $this->modalCartAddName = $spice->nama;
            $this->modalCartAddPrice = $spice->hrg_jual;
            $this->modalCartAddQty = 1;
            $this->modalCartAddImage = $spice->image;
            $this->modalCartAddCount = count($carts);
            foreach ($carts as $cart) {
                $this->modalCartAddTotal = $this->modalCartAddTotal + ($cart->spice_price * $cart->jumlah);
            }

            $this->feedbackCartAddModal = true;

            $this->emit('headerMount');
        }
    }
}
