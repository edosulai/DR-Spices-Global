<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
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
            'supplier_id' => Supplier::factory(),
            'faktur' => $this->faker->numerify('FAK.######'),
            'spice_id' => Spice::factory(),
            'jumlah' => $this->faker->numberBetween(1, 10),
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'ket' => 'pas',
        ];
    }
}
