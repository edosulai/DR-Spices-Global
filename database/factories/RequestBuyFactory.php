<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Postage;
use App\Models\RequestBuy;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Spice;
use App\Models\Status;
use App\Models\Trace;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestBuy>
 */
class RequestBuyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::oldest()->get()[rand(0, User::count() - 1)];

        $address = Address::where('primary', true)->where('user_id', $user->id)
            ->selectRaw('addresses.*, countries.nicename as nicename, countries.iso3 as iso3')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->first();

        $postage = Postage::where('country_id', $address->country_id)->first();

        $parts = explode(" ", $user->name);
        $user_lastname = array_pop($parts);
        $user_firstname = implode(" ", $parts);

        $parts = explode(" ", $address->recipent);
        $address_lastname = array_pop($parts);
        $address_firstname = implode(" ", $parts);

        $spice_data = [];
        $gross_amount = 0;

        $spice = Spice::selectRaw('spices.*, spice_images.image as image')
            ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
            ->oldest()
            ->get();

        for ($i = 0; $i < rand(1, Spice::count()); $i++) {
            $jumlah = $this->faker->numberBetween(1, 10);
            $spice_data[] = [
                'id' => $spice[$i]->id,
                'nama' => $spice[$i]->nama,
                'hrg_jual' => $spice[$i]->hrg_jual,
                'jumlah' => $jumlah,
                'unit' => $spice[$i]->unit,
                'image' => $spice[$i]->image,
                'ket' => $spice[$i]->ket,
            ];

            $gross_amount = $gross_amount + ($jumlah * $spice[$i]->hrg_jual) + ($jumlah * $postage->cost);
        }

        $order_id = "INV/" . Carbon::now()->format('Ymd') . '/' . sprintf('%09d', rand(0, 999999999));

        while (RequestBuy::where('invoice', $order_id)->first()) {
            $order_id = "INV/" . Carbon::now()->format('Ymd') . '/' . sprintf('%09d', rand(0, 999999999));
        }

        $expirationdate = explode("/", $this->faker->creditCardExpirationDateString);

        $transaction_data = [
            'payment_type' => 'credit_card',
            'credit_card'  => [
                "token_id" => Str::orderedUuid(),
                "authentication" => "true",
                "card_number" => $this->faker->creditCardNumber,
                "card_exp_month" => $expirationdate[0],
                "card_exp_year" => "20" . $expirationdate[1],
                "card_cvv" => $this->faker->numberBetween(100, 999),
            ],
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
            ],
            'customer_details' => [
                "first_name" => $user_firstname,
                "last_name" => $user_lastname,
                "email" => $user->email,
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
                ],
            ],
            "postage" => $postage->toArray(),
            "charge_response" => [
                "status_code" => "200",
                "status_message" => "Success, Credit Card transaction is successful",
                "channel_response_code" => "00",
                "channel_response_message" => "Approved",
                "bank" => "cimb",
                "eci" => "05",
                "transaction_id" => Str::orderedUuid(),
                "order_id" => $order_id,
                "merchant_id" => env('MIDTRANS_ID_MERCHANT'),
                "gross_amount" => $gross_amount . ".00",
                "currency" => "IDR",
                "payment_type" => "credit_card",
                "transaction_time" => Carbon::now()->format('Y-m-d H:i:s'),
                "transaction_status" => "capture",
                "fraud_status" => "accept",
                "approval_code" => $this->faker->numerify('#############'),
                "masked_card" => $this->faker->numerify("######-####"),
                "card_type" => "credit",
            ],
            "currency_exchange" => [
                env('DEFAULT_EXCHANGE') => currency(1, null, env('DEFAULT_EXCHANGE'), false),
                'IDR' => currency(1, null, 'IDR', false)
            ]
        ];

        return [
            'invoice' => "INV/" . Carbon::now()->format('Ymd') . '/' . sprintf('%09d', rand(0, 999999999)),
            'user_id' => $user->id,
            'spice_data' => $spice_data,
            'transaction_data' => $transaction_data,
            'created_at' => Carbon::now()->subDay(rand(20, 30)),
            'updated_at' => Carbon::now()->subDay(rand(20, 30))
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (RequestBuy $request_buy) {
            foreach ($request_buy->spice_data as $data) {
                $spice = Spice::find($data['id']);
                $spice->stok = $spice->stok - $data['jumlah'];
                $spice->save();
            }

            $statuses = Status::oldest()->get();
            $statusSelected = rand(1, Status::count());

            $trace = [];
            for ($i = 0; $i < $statusSelected; $i++) {
                $trace[] = [
                    'id' => Str::orderedUuid(),
                    'request_buy_id' => $request_buy->id,
                    'status_id' => $statuses[$i]->id,
                    'created_at' => $request_buy->created_at->addDay($statuses->count() + $i),
                    'updated_at' => $request_buy->updated_at->addDay($statuses->count() + $i)
                ];
            }
            Trace::insert($trace);

            if (in_array($statuses[$statusSelected - 1]->nama, ['Rated'])) {
                foreach ($request_buy->spice_data as $data) {
                    Review::create([
                        'user_id' => $request_buy->user_id,
                        'spice_id' => $data['id'],
                        'request_buy_id' => $request_buy->id,
                        'summary' => $this->faker->paragraph(),
                        'rating' => $this->faker->numberBetween(1, 5),
                    ]);
                }
            }

            if (in_array($statuses[$statusSelected - 1]->nama, ['Rejected', 'Canceled'])) {
                $request_buy->refund = rand(1, 2);
                $request_buy->save();
            }
        });
    }
}
