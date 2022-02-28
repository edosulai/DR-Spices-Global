<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Income;
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
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'faktur' => $this->faker->numerify('FAK.######'),
            'spice_id' => $this->faker->numberBetween(1, Spice::count()),
            'jumlah' => $this->faker->numberBetween(1, 10),
            'ket' => 'pas',
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
            $spice = Spice::find($income->spice_id);
            $spice->stok = $spice->stok - $income->jumlah;
            $spice->save();
        });
    }
}
