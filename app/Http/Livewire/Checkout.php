<?php

namespace App\Http\Livewire;

use Midtrans\Config;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Postage;
use App\Models\RequestBuy;
use App\Models\Spice;
use App\Models\Status;
use App\Models\Trace;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Midtrans\CoreApi;

class Checkout extends Component
{
    public $headerAddressModal = '';
    public $queryAddressModal = false;
    public $deleteAddressModal = false;
    public $modal = [];
    public $addresses;
    public $countries;

    public $payment;
    public $carts;
    public $postage;
    public $head_message;
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

        $this->modal = [];
        $this->queryAddressModal = false;
        $this->deleteAddressModal = false;
        $this->countries = Country::all();
        $this->carts = collect();

        $carts = Cart::where('user_id', Auth::id())
            ->join('spices', 'carts.spice_id', '=', 'spices.id')
            ->selectRaw('carts.*, spices.nama as spice_nama, spices.hrg_jual as spice_price, spices.image as spice_image')
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
                    'img_src' => asset("storage/images/product/$cart->spice_image"),
                    'unit' => 'KG',
                ]);
            }

            $this->addresses = Address::where('addresses.user_id', Auth::id())
                ->selectRaw('addresses.*, countries.nicename as countries_nicename')
                ->join('countries', 'addresses.country_id', '=', 'countries.id')
                ->get()->toArray();

            if ($this->addresses) {
                $this->postage = Postage::where('country_id', Address::where('primary', true)->where('user_id', Auth::id())->first()->country_id)->first();
            }
        } else {
            $this->redirectRoute('cart');
        }
    }

    public function openModalAddress($id = null)
    {
        $isExist = Address::where('id', $id)->where('user_id', Auth::id())->first();
        if ($isExist) {
            $this->modal = $isExist->toArray();
            $this->headerAddressModal = 'Update Address';
        } else {
            $this->headerAddressModal = 'Add New Address';
        }

        $this->queryAddressModal = true;
    }

    public function queryAddress()
    {
        if (array_key_exists('id', $this->modal)) {
            $new = Address::where('id', $this->modal['id'])->where('user_id', Auth::id())->first();
            $new->fill($this->modal);
            $new->save();
        } else {
            $new = Address::create($this->modal);
            if (!Address::where('primary', true)->where('user_id', Auth::id())->first()) {
                $this->emit('mainAddress', $new->id);
            }
        }

        $this->emit('checkoutMount');
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

    public function openDeleteModal($id)
    {
        $isExist = Address::where('id', $id)->where('user_id', Auth::id())->first();
        if ($isExist) {
            $this->modal = $isExist->toArray();
            $this->deleteAddressModal = true;
        }
    }

    public function deleteAddress()
    {
        Address::where('id', $this->modal['id'])->where('user_id', Auth::id())->delete();
        $this->emit('checkoutMount');
    }

    public function getToken()
    {
        $expirationdate = explode("/", $this->payment['expirationdate']);

        $response = Http::get(env('MIDTRANS_URL') . "/v2/token", [
            "card_number" => $this->payment['cardnumber'],
            "card_exp_month" => $expirationdate[0],
            "card_exp_year" => "20" . $expirationdate[1],
            "card_cvv" => $this->payment['securitycode'],
            "secure" => "true",
            "gross_amount" => $this->carts->sum(fn ($cart) => $cart['qty'] * ($cart['price'] + $this->postage->cost)),
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

        $gross_amount = $this->carts->sum(fn ($cart) => $cart['qty'] * ($cart['price'] + $this->postage->cost));

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
                "price" => ($cart['price'] + $this->postage->cost),
                "quantity" => $cart['qty'],
                "name" => $cart['name'],
                "url" => url(str_replace(' ', '-', $cart['name']))
            ];

            $spice = Spice::find($cart['spice_id']);

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
                        'gross_amount' => $gross_amount,
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
                            "city" => $address->city,
                            "postal_code" => $address->zip,
                            "country_code" => $address->iso3,
                            "country_name" => $address->nicename
                        ]
                    ],
                    "postage" => $this->postage->toArray(),
                    "charge_response" => $response
                ],
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
