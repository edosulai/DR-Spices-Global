<?php

namespace Database\Factories;

use App\Models\Income;
use App\Models\RequestBuy;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Spice;
use App\Models\Status;

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
        return [
            'invoice' => $this->faker->uuid,
            'user_id' => $this->faker->randomElements(User::all()->map(fn ($model) => $model->id))[0],
            'spice_data' => json_encode($this->faker->randomElements(Spice::all()->toArray())[0]),
            'status_id' => $this->faker->randomElements(Status::all()->map(fn ($model) => $model->id))[0],
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
            $spice_id = json_decode($request_buy->spice_data)->id;
            $spice = Spice::find($spice_id);
            $spice->stok = $spice->stok - $request_buy->jumlah;
            $spice->save();

            $statusCompleted = Status::where('nama', 'Completed')->first();
            $statusRated = Status::where('nama', 'Rated')->first();

            if ($request_buy->status_id == $statusCompleted->id || $request_buy->status_id == $statusRated->id) {
                Income::create([
                    'user_id' => $request_buy->user_id,
                    'request_buy_id' => $request_buy->id,
                ]);
            }

            if ($request_buy->status_id == $statusRated->id) {
                Review::create([
                    'user_id' => $request_buy->user_id,
                    'spice_id' => $spice_id,
                    'request_buy_id' => $request_buy->id,
                    'summary' => $this->faker->paragraph(),
                    'rating' => $this->faker->numberBetween(1, 5),
                ]);
            }
        });
    }
}
