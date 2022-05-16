<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Spice;
use App\Models\SpiceImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ProductDetail extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $spice;
    public $spice_image;
    public $qty = 1;
    public $spices;

    public $feedbackDetailModal = false;
    public $warningDetailModal = false;
    public $status_message;
    public $validation_messages = [];
    public $modal = [];

    protected $rules = [
        'qty' => 'required|integer|min:1',
    ];

    protected $validationAttributes = [
        'qty' => 'Quantity',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function mount()
    {
        $this->spice = Spice::where('nama', 'like', '%' . Str::replace('-', ' ', request()->product) . '%')
            ->selectRaw('spices.*, AVG(reviews.rating) as rating_avg')
            ->join('reviews', 'spices.id', '=', 'reviews.spice_id', 'left outer')
            ->groupBy('spices.id')
            ->first();

        if (!$this->spice) abort(404);

        $this->spice_image = SpiceImage::where('spice_id', $this->spice->id)->get();

        DB::statement(DB::raw("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')), @row:=0"));
        $this->spices = Spice::selectRaw('spices.*, AVG(reviews.rating) as rating_avg, spice_images.image as image')
            ->join('reviews', 'spices.id', '=', 'reviews.spice_id', 'left outer')
            ->join('spice_images', 'spices.id', '=', 'spice_images.spice_id')
            ->groupBy('spices.id')
            ->get();
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }

        $this->validate();

        $spice = Spice::where('spices.id', $this->spice->id)
            ->selectRaw('spices.*, spice_images.image as image')
            ->join('spice_images', 'spices.id', '=', 'spice_images.spice_id')
            ->first();

        if ($spice && $spice->stok > 0) {

            $this->modal['total'] = 0;

            Cart::updateOrCreate([
                'user_id' => Auth::id(),
                'spice_id' => $spice->id
            ], [
                'jumlah' => DB::raw('jumlah + ' . $this->qty),
            ]);

            $carts = Cart::where('user_id',  Auth::id())
                ->join('spices', 'carts.spice_id', '=', 'spices.id')
                ->selectRaw('carts.*, spices.nama as spice_nama, spices.hrg_jual as spice_price')
                ->get();

            $this->modal['name'] = $spice->nama;
            $this->modal['price'] = $spice->hrg_jual;
            $this->modal['unit'] = $spice->unit;
            $this->modal['rating'] = 0;
            $this->modal['qty'] = $this->qty;
            $this->modal['image'] = asset("/storage/images/products/$spice->image");;
            $this->modal['desc'] = $spice->ket;
            $this->modal['count'] = count($carts);
            $this->modal['instock'] = $spice->stok;

            foreach ($carts as $cart) {
                $this->modal['total'] = $this->modal['total'] + ($cart->spice_price * $cart->jumlah);
            }

            $this->feedbackDetailModal = true;
            $this->emit('headerMount');
        } else {
            $this->status_message = 'Sold Out';
            $this->validation_messages = [
                'Stock is not enough',
                'Product is not available'
            ];
            $this->warningDetailModal = true;
        }
    }

    public function render()
    {
        return view('livewire.product-detail', [
            'reviews' => Review::where('spice_id', $this->spice->id)
                ->join('users', 'reviews.user_id', '=', 'users.id')
                ->selectRaw('reviews.*, users.name as users_name')
                ->latest()
                ->paginate(5)
        ]);
    }
}
