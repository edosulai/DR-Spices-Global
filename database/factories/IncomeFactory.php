<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Income;
use App\Models\Review;
use App\Models\User;
use App\Models\Spice;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'faktur' => $this->faker->numerify('FAK.######'),
            'user_id' => $this->faker->randomElements(User::all()->map(fn ($model) => $model->id))[0],
            'spice_data' => json_encode($this->faker->randomElements(Spice::all()->toArray())[0]),
            'jumlah' => $this->faker->numberBetween(1, 10),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Income $income) {
            $spice = Spice::find(json_decode($income->spice_data)->id);
            $spice->stok = $spice->stok - $income->jumlah;
            $spice->save();

            Review::create([
                'user_id' => $income->user_id,
                'spice_id' => json_decode($income->spice_data)->id,
                'summary' => $this->faker->paragraph(),
                'rating' => $this->faker->numberBetween(1, 5),
            ]);
        });
    }
}
