<?php

namespace App\Http\Livewire;

use Midtrans\Config;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Postage;
use App\Models\RequestBuy;
use App\Models\Spice;
use App\Models\Status;
use App\Models\Trace;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Midtrans\CoreApi;

class Checkout extends Component
{
    public $payment;
    public $carts;
    public $postage;
    public $head_message;
    public $status_message;
    public $validation_messages = [];
    public $warningModal = false;

    protected $listeners = [
        'checkoutMount' => 'mount',
        'errorPayment' => 'errorPayment',
        'doPayment' => 'doPayment',
    ];

    protected $rules = [
        'payment.name' => 'required',
        'payment.cardnumber' => 'required',
        'payment.expirationdate' => 'required',
        'payment.securitycode' => 'required|integer',
    ];

    protected $validationAttributes = [
        'payment.name' => 'Card Name',
        'payment.cardnumber' => 'Card Number',
        'payment.expirationdate' => 'Card Expiration Date',
        'payment.securitycode' => 'Card Security Code',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function mount()
    {
        $this->payment = [
            // 'name' => 'Edo Sulaiman',
            // 'cardnumber' => '4811111111111114',
            // 'expirationdate' => '12/24',
            // 'securitycode' => '123'
            'name' => '',
            'cardnumber' => '',
            'expirationdate' => '',
            'securitycode' => ''
        ];

        $this->carts = collect();
        $this->postage = null;

        $carts = Cart::where('user_id', Auth::id())
            ->selectRaw('carts.*, spices.nama as spice_nama, spices.hrg_jual as spice_price, spice_images.image as spice_image')
            ->join('spices', 'carts.spice_id', '=', 'spices.id')
            ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
            ->get();

        if ($carts->isNotEmpty()) {
            foreach ($carts as $cart) {
                $this->carts->push([
                    'id' => $cart->id,
                    'spice_id' => $cart->spice_id,
                    'name' => $cart->spice_nama,
                    'url' => Str::replace(' ', '-', $cart->spice_nama),
                    'qty' => $cart->jumlah,
                    'price' => $cart->spice_price,
                    'img_src' => asset("storage/images/products/$cart->spice_image"),
                    'unit' => 'KG',
                ]);
            }

            $main_address = Address::where('primary', true)->where('user_id', Auth::id())->first();

            if ($main_address) {
                $this->postage = Postage::where('country_id', $main_address->country_id)->first();
            }
        } else {
            $this->redirectRoute('cart');
        }
    }

    public function getToken()
    {
        $this->validate();

        $expirationdate = explode("/", $this->payment['expirationdate']);

        $response = Http::get(env('MIDTRANS_URL') . "/v2/token", [
            "card_number" => $this->payment['cardnumber'],
            "card_exp_month" => $expirationdate[0],
            "card_exp_year" => "20" . $expirationdate[1],
            "card_cvv" => $this->payment['securitycode'],
            "secure" => "true",
            "gross_amount" => $this->carts->sum(fn ($cart) => $cart['qty'] * (int) currency($cart['price'] + $this->postage->cost, null, 'IDR', false)),
            "client_key" => env('MIDTRANS_CLIENT_KEY'),
        ]);

        $response = $response->json();

        if ($response['status_code'] == 200) {
            $this->dispatchBrowserEvent('payauth', $response);
        } else {
            $this->emit('errorPayment', $response);
        }
    }

    public function errorPayment($response)
    {
        $this->head_message = 'Something Error.';
        $this->status_message = str_replace('One or more parameters in the payload is invalid', 'Payment Failed', $response['status_message']);
        if (array_key_exists('validation_messages', $response)) {
            $this->validation_messages = collect($response['validation_messages'])->map(function ($item) {
                $item = str_replace('card_number', 'Card number', $item);
                $item = str_replace('card_exp_year', 'Card Expire Year', $item);
                $item = str_replace('card_exp_month', 'Card Expire Month', $item);
                $item = str_replace('card_cvv', 'Card CVV', $item);
                $item = str_replace('gross_amount', 'Gross Amount', $item);
                $item = str_replace('with luhn algorithm', '', $item);
                return $item;
            });
        }
        $this->warningModal = true;
    }

    public function doPayment($auth)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        // Config::$appendNotifUrl = "https://example.com";
        // Config::$overrideNotifUrl = "https://example.com";
        // Config::$paymentIdempotencyKey = "Unique-ID";

        $expirationdate = explode("/", $this->payment['expirationdate']);

        $address = Address::where('primary', true)->where('user_id', Auth::id())
            ->selectRaw('addresses.*, countries.nicename as nicename, countries.iso3 as iso3')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->first();

        $parts = explode(" ", Auth::user()->name);
        $user_lastname = array_pop($parts);
        $user_firstname = implode(" ", $parts);

        $parts = explode(" ", $address->recipent);
        $address_lastname = array_pop($parts);
        $address_firstname = implode(" ", $parts);

        $item_details = [];
        $spice_data = [];

        foreach ($this->carts as $cart) {
            $item_details[] = [
                "id" => $cart['spice_id'],
                "price" => (int) currency($cart['price'] + $this->postage->cost, null, 'IDR', false),
                "quantity" => $cart['qty'],
                "name" => $cart['name'],
                "url" => url(str_replace(' ', '-', $cart['name']))
            ];

            $spice = Spice::where('spices.id', $cart['spice_id'])
                ->selectRaw('spices.*, spice_images.image as image')
                ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
                ->first();

            $spice_data[] = [
                'id' => $spice->id,
                'nama' => $spice->nama,
                'hrg_jual' => $spice->hrg_jual,
                'jumlah' => $cart['qty'],
                'unit' => $spice->unit,
                'image' => $spice->image,
                'ket' => $spice->ket,
            ];
        }

        $order_id = "INV/" . Carbon::now()->format('Ymd') . '/' . sprintf('%09d', rand(0, 999999999));

        while (RequestBuy::where('invoice', $order_id)->first()) {
            $order_id = "INV/" . Carbon::now()->format('Ymd') . '/' . sprintf('%09d', rand(0, 999999999));
        }

        $response = CoreApi::charge([
            'payment_type' => 'credit_card',
            'credit_card'  => [
                "token_id" => $auth['token_id'],
                "authentication" => "true",
            ],
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $this->carts->sum(fn ($cart) => $cart['qty'] * (int) currency($cart['price'] + $this->postage->cost, null, 'IDR', false))
            ],
            'item_details' => $item_details,
            'customer_details' => [
                "first_name" => $user_firstname,
                "last_name" => $user_lastname,
                "email" => Auth::user()->email,
                "shipping_address" => [
                    "first_name" => $address_firstname,
                    "last_name" => $address_lastname,
                    "phone" => $address->phone,
                    "address" =>  $address->street . ", " . $address->other_street . ", " . $address->district . ", " . $address->city . ", " . $address->state . ", " . $address->nicename,
                    "city" => $address->city,
                    "postal_code" => $address->zip,
                    "country_code" => $address->iso3
                ]
            ]
        ]);

        if ($response->status_code == "200") {

            $request_buy = RequestBuy::create([
                'invoice' => $order_id,
                'user_id' => Auth::id(),
                'spice_data' => $spice_data,
                'transaction_data' => [
                    'payment_type' => 'credit_card',
                    'credit_card'  => [
                        "token_id" => $auth['token_id'],
                        "authentication" => "true",
                        "card_number" => $this->payment['cardnumber'],
                        "card_exp_month" => $expirationdate[0],
                        "card_exp_year" => "20" . $expirationdate[1],
                        "card_cvv" => $this->payment['securitycode'],
                    ],
                    'transaction_details' => [
                        'order_id' => $order_id,
                        'gross_amount' => $this->carts->sum(fn ($cart) => $cart['qty'] * ($cart['price'] + $this->postage->cost)),
                    ],
                    'customer_details' => [
                        "first_name" => $user_firstname,
                        "last_name" => $user_lastname,
                        "email" => Auth::user()->email,
                        "shipping_address" => [
                            "first_name" => $address_firstname,
                            "last_name" => $address_lastname,
                            "phone" => $address->phone,
                            "address" =>  $address->street . ", " . $address->other_street . ", " . $address->district . ", " . $address->city . ", " . $address->state . ", " . $address->nicename,
                            "street" => $address->street,
                            "other_street" => $address->other_street,
                            "district" => $address->district,
                            "city" => $address->city,
                            "state" => $address->state,
                            "postal_code" => $address->zip,
                            "country_code" => $address->iso3,
                            "country_name" => $address->nicename
                        ]
                    ],
                    "postage" => $this->postage->toArray(),
                    "charge_response" => $response,
                    "currency_exchange" => [
                        env('DEFAULT_EXCHANGE') => currency(1, null, env('DEFAULT_EXCHANGE'), false),
                        'IDR' => currency(1, null, 'IDR', false)
                    ]
                ]
            ]);

            foreach ($request_buy->spice_data as $data) {
                $spice = Spice::find($data['id']);
                $spice->stok = $spice->stok - $data['jumlah'];
                $spice->save();
            }

            foreach ($this->carts as $cart) {
                Cart::find($cart['id'])->delete();
            }

            $statuses = Status::oldest()->get();

            for ($i = 0; $i < 2; $i++) {
                Trace::create([
                    'request_buy_id' => $request_buy->id,
                    'status_id' => $statuses[$i]->id,
                ]);
            }

            $this->redirectRoute('purchase', ['invoice' => base64_encode($order_id)]);
        } else {
            $this->emit('errorPayment', $response);
        }
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
