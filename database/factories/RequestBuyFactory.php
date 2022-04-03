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
            'invoice' => $this->faker->uuid,
            'user_id' => $this->faker->randomElements(User::all()->map(fn ($model) => $model->id))[0],
            'spice_data' => json_encode($this->faker->randomElements(Spice::all()->toArray())[0]),
            'status_id' => $this->faker->randomElements(Status::all()->map(fn ($model) => $model->id))[0],
            'jumlah' => $this->faker->numberBetween(1, 10),
        ];
    }
}
