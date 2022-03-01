<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Expenditure;
use App\Models\Supplier;
use App\Models\Spice;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\expenditure>
 */
class ExpenditureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'supplier_id' => $this->faker->numberBetween(1, Supplier::count()),
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
        return $this->afterCreating(function (Expenditure $expenditure) {
            $spice = Spice::find($expenditure->spice_id);
            $spice->stok = $spice->stok + $expenditure->jumlah;
            $spice->save();
        });
    }
}