<?php

namespace Database\Factories;

use App\Models\Income;
use App\Models\RequestBuy;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Spice;
use App\Models\Status;
use App\Models\Trace;
use Illuminate\Support\Carbon;
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
        $spice_data = [];

        for ($i = 0; $i < rand(1, Spice::count()); $i++) {
            $spice = Spice::oldest()->get()->toArray()[$i];
            $spice_data[] = [
                'id' => $spice['id'],
                'nama' => $spice['nama'],
                'hrg_jual' => $spice['hrg_jual'],
                'jumlah' => $this->faker->numberBetween(1, 10),
                'unit' => $spice['unit'],
                'image' => $spice['image'],
                'ket' => $spice['ket'],
            ];
        }

        return [
            'invoice' => "INV/" . Carbon::now()->format('Ymd') . '/' . sprintf('%09d', rand(0, 999999999)),
            'user_id' => User::oldest()->get()->map(fn ($model) => $model->id)[rand(0, User::count() - 1)],
            'spice_data' => $spice_data,
            'created_at' => Carbon::now()->subDay(rand(1, 90)),
            'updated_at' => Carbon::now()->subDay(rand(1, 90))
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
                $spice = Spice::find($data->id);
                $spice->stok = $spice->stok - $data->jumlah;
                $spice->save();
            }

            $trace = [];
            $statuses = Status::oldest()->get();
            $statusSelected = rand(0, Status::count() - 1);

            for ($i = 0; $i < $statusSelected; $i++) {
                $trace[] = [
                    'id' => Str::orderedUuid(),
                    'request_buy_id' => $request_buy->id,
                    'status_id' => $statuses[$i]->id,
                    'created_at' => Carbon::now()->subDay($statuses->count() - $i),
                    'updated_at' => Carbon::now()->subDay($statuses->count() - $i)
                ];
            }

            Trace::insert($trace);

            if ($statuses[$statusSelected]->nama == 'Rated' || $statuses[$statusSelected]->nama = 'Delivered') {
                Income::create([
                    'user_id' => $request_buy->user_id,
                    'request_buy_id' => $request_buy->id,
                    'created_at' => $request_buy->created_at,
                    'updated_at' => $request_buy->updated_at
                ]);
            }

            if ($statuses[$statusSelected]->nama == 'Rated') {
                $review = [];

                foreach ($request_buy->spice_data as $data) {
                    $review[] = [
                        'id' => Str::orderedUuid(),
                        'user_id' => $request_buy->user_id,
                        'spice_id' => $data->id,
                        'request_buy_id' => $request_buy->id,
                        'summary' => $this->faker->paragraph(),
                        'rating' => $this->faker->numberBetween(1, 5),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }

                Review::insert($review);
            }
        });
    }
}
