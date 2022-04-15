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
        $usersSelected = rand(0, User::count() - 1);

        return [
            'invoice' => $this->faker->numerify(Carbon::now()->format('Ymd') . '/' . sprintf('%03d', $usersSelected + 1) . '#####'),
            'user_id' => User::oldest()->get()->map(fn ($model) => $model->id)[$usersSelected],
            'spice_data' => $this->faker->randomElements(Spice::all()->toArray())[0],
            'jumlah' => $this->faker->numberBetween(1, 3),
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
            $spice = Spice::find($request_buy->spice_data->id);
            $spice->stok = $spice->stok - $request_buy->jumlah;
            $spice->save();

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
                ]);
            }

            if ($statuses[$statusSelected]->nama == 'Rated') {
                Review::create([
                    'user_id' => $request_buy->user_id,
                    'spice_id' => $request_buy->spice_data->id,
                    'request_buy_id' => $request_buy->id,
                    'summary' => $this->faker->paragraph(),
                    'rating' => $this->faker->numberBetween(1, 5),
                ]);
            }
        });
    }
}
