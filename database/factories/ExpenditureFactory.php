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
            'faktur' => $this->faker->numerify('FAK.######'),
            'supplier_data' => json_encode($this->faker->randomElements(Supplier::all()->toArray())[0]),
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
        return $this->afterCreating(function (Expenditure $expenditure) {
            $spice = Spice::find(json_decode($expenditure->spice_data)->id);
            $spice->stok = $spice->stok + $expenditure->jumlah;
            $spice->save();
        });
    }
}
