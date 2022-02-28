<?php

namespace Database\Factories;

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
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'spice_id' => $this->faker->numberBetween(1, Spice::count()),
            'status_id' => $this->faker->numberBetween(1, Status::count()),
            'jumlah' => $this->faker->numberBetween(1, 10),
        ];
    }
}
