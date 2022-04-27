<?php

namespace App\Http\Livewire;

use Midtrans\Config;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Postage;
use App\Models\RequestBuy;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Midtrans\CoreApi;

class Checkout extends Component
{
    public $payment;
    public $modal;
    public $carts;
    public $countries;
    public $addresses;
    public $postage;
    public $queryAddressModal = false;

    public $status_message;
    public $validation_messages = [];
    public $warningModal = false;

    protected $listeners = [
        'checkoutMount' => 'mount',
        'mainAddress' => 'mainAddress',
        'errorPayment' => 'errorPayment',
        'doPayment' => 'doPayment',
    ];

    public function mount()
    {
        $this->payment = [
            'name' => 'Edo Sulaiman',
            'cardnumber' => '4811111111111114',
            'expirationdate' => '12/24',
            'securitycode' => '123'
        ];

        $this->carts = collect();

        $carts = Cart::where('user_id', Auth::id())
            ->join('spices', 'carts.spice_id', '=', 'spices.id')
            ->selectRaw('carts.*, spices.nama as spice_nama, spices.hrg_jual as spice_price, spices.image as spice_image')
            ->get();

        if ($carts->isNotEmpty()) {
            foreach ($carts as $cart) {
                $this->carts->push([
                    'id' => $cart->id,
                    'name' => $cart->spice_nama,
                    'url' => Str::replace(' ', '-', $cart->spice_nama),
                    'qty' => $cart->jumlah,
                    'price' => $cart->spice_price,
                    'img_src' => asset("storage/images/product/$cart->spice_image"),
                    'unit' => 'KG',
                ]);
            }

            $this->countries = Country::all();

            $this->addresses = Address::where('addresses.user_id', Auth::id())
                ->selectRaw('addresses.*, countries.nicename as countries_nicename')
                ->join('countries', 'addresses.country_id', '=', 'countries.id')
                ->get()->toArray();

            $this->postage = Postage::where('country_id', Address::where('primary', true)->where('user_id', Auth::id())->first()->country_id)->first();
        } else {
            $this->redirectRoute('cart');
        }
    }

    public function mainAddress($id)
    {
        $address = Address::where('id', $id)->where('user_id', Auth::id())->first();

        if ($address) {
            $mainAddress = Address::where('primary', true)->where('user_id', Auth::id())->first();
            if ($mainAddress) {
                $mainAddress->primary = false;
                $mainAddress->save();
            }
            $address->primary = true;
            $address->save();
        }

        $this->emit('checkoutMount');
    }

    public function queryAddress()
    {
        $new = Address::create($this->modal);
        $this->emit('mainAddress', $new->id);

        $this->modal = [];
        $this->queryAddressModal = false;
    }

    public function getToken()
    {
        $gross_amount = $this->carts->sum(fn ($cart) => ($cart['qty'] == '' ? 0 : $cart['qty']) * $cart['price']) + ($this->carts->sum(fn ($cart) => $cart['qty']) * $this->postage->cost);
        $expirationdate = explode("/", $this->payment['expirationdate']);

        $response = Http::get(env('MIDTRANS_TOKEN_URL'), [
            "card_number" => $this->payment['cardnumber'],
            "card_exp_month" => $expirationdate[0],
            "card_exp_year" => "20" . $expirationdate[1],
            "card_cvv" => $this->payment['securitycode'],
            "secure" => "true",
            "gross_amount" => $gross_amount,
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
        $this->status_message = str_replace('One or more parameters in the payload is invalid', 'Payment Failed', $response['status_message']);
        if ($response['validation_messages']) {
            $this->validation_messages = collect($response['validation_messages'])->map(function ($item) {
                $item = str_replace('card_number', 'Card number', $item);
                $item = str_replace('card_exp_year', 'Card Expire Year', $item);
                $item = str_replace('card_exp_month', 'Card Expire Month', $item);
                $item = str_replace('card_cvv', 'Card CVV', $item);
                $item = str_replace('with luhn algorithm', '', $item);
                return $item;
            });
        }
        $this->warningModal = true;
    }

    public function doPayment($response)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        // Config::$appendNotifUrl = "https://example.com";
        // Config::$overrideNotifUrl = "https://example.com";
        // Config::$paymentIdempotencyKey = "Unique-ID";

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

        foreach ($this->carts as $cart) {
            $item_details[] = [
                "id" => $cart['id'],
                "price" => $cart['price'],
                "quantity" => $cart['qty'],
                "name" => $cart['name'],
                "url" => url(str_replace(' ', '-', $cart['name']))
            ];
        }

        $gross_amount = $this->carts->sum(fn ($cart) => ($cart['qty'] == '' ? 0 : $cart['qty']) * $cart['price']) + ($this->carts->sum(fn ($cart) => $cart['qty']) * $this->postage->cost);

        $order_id = "INV/" . Carbon::now()->format('Ymd') . '/' . sprintf('%09d', rand(0, 999999999));

        while (RequestBuy::where('invoice', $order_id)->first()) {
            $order_id = "INV/" . Carbon::now()->format('Ymd') . '/' . sprintf('%09d', rand(0, 999999999));
        }

        $transaction_data = [
            'payment_type' => 'credit_card',
            'credit_card'  => [
                "token_id" => $response['token_id'],
                "authentication" => "true",
            ],
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
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
        ];

        $response = CoreApi::charge($transaction_data);

        dd($response);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
