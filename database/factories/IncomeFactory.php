<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
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
            'user_id' => User::factory(),
            'faktur' => $this->faker->numerify('FAK.######'),
            'spice_id' => Spice::factory(),
            'jumlah' => $this->faker->numberBetween(1, 10),
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'ket' => 'pas',
        ];
    }
}
