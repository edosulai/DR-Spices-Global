<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RequestBuy;
use App\Models\User;


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
            'user_id' => $this->faker->randomElements(User::all()->map(fn ($model) => $model->id))[0],
            'request_buy_id' => $this->faker->randomElements(RequestBuy::all()->map(fn ($model) => $model->id))[0],
        ];
    }
}
