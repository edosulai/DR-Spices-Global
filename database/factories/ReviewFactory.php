<?php

namespace Database\Factories;

use App\Models\RequestBuy;
use App\Models\Spice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElements(User::all()->map(fn ($model) => $model->id))[0],
            'spice_id' => $this->faker->randomElements(Spice::all()->map(fn ($model) => $model->id))[0],
            'request_buy_id' => $this->faker->randomElements(RequestBuy::all()->map(fn ($model) => $model->id))[0],
            'summary' => $this->faker->paragraph(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
