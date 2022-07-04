<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Maggot;
use App\Models\MaggotImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ProductDetail extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $maggot;
    public $maggot_image;
    public $qty = 1;
    public $maggots;

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

    // public function updated()
    // {
    //     $this->validate($this->rules);
    // }

    public function mount()
    {
        $this->maggot = Maggot::where('nama', 'like', '%' . Str::replace('-', ' ', request()->product) . '%')
            ->selectRaw('maggots.*, AVG(reviews.rating) as rating_avg')
            ->join('reviews', 'maggots.id', '=', 'reviews.maggot_id', 'left outer')
            ->groupBy('maggots.id')
            ->first();

        if (!$this->maggot) abort(404);

        $this->maggot_image = MaggotImage::where('maggot_id', $this->maggot->id)->get();

        DB::statement(DB::raw("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')), @row:=0"));
        $this->maggots = Maggot::whereNot(function ($query) {
            $query->where('maggots.id', '=', $this->maggot->id);
        })
            ->selectRaw('maggots.*, AVG(reviews.rating) as rating_avg, maggot_images.image as image')
            ->join('reviews', 'maggots.id', '=', 'reviews.maggot_id', 'left outer')
            ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
            ->groupBy('maggots.id')
            ->get();
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return $this->redirectRoute('login');
        }

        $this->validate();

        $maggot = Maggot::where('maggots.id', $this->maggot->id)
            ->selectRaw('maggots.*, maggot_images.image as image')
            ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
            ->first();

        if ($maggot && $maggot->stok > 0) {

            $this->modal['total'] = 0;

            Cart::updateOrCreate([
                'user_id' => Auth::id(),
                'maggot_id' => $maggot->id
            ], [
                'jumlah' => DB::raw('jumlah + ' . $this->qty),
            ]);

            $carts = Cart::where('user_id',  Auth::id())
                ->join('maggots', 'carts.maggot_id', '=', 'maggots.id')
                ->selectRaw('carts.*, maggots.nama as maggot_nama, maggots.hrg_jual as maggot_price')
                ->get();

            $this->modal['name'] = $maggot->nama;
            $this->modal['price'] = $maggot->hrg_jual;
            $this->modal['unit'] = $maggot->unit;
            $this->modal['rating'] = 0;
            $this->modal['qty'] = $this->qty;
            $this->modal['image'] = asset("/storage/images/products/$maggot->image");;
            $this->modal['desc'] = $maggot->ket;
            $this->modal['count'] = count($carts);
            $this->modal['instock'] = $maggot->stok;

            foreach ($carts as $cart) {
                $this->modal['total'] = $this->modal['total'] + ($cart->maggot_price * $cart->jumlah);
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
            'reviews' => Review::where('maggot_id', $this->maggot->id)
                ->join('users', 'reviews.user_id', '=', 'users.id')
                ->selectRaw('reviews.*, users.name as users_name')
                ->latest()
                ->paginate(5)
        ]);
    }
}
