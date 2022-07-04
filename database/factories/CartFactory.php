<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Maggot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->withFaker()->randomElements(User::all()->map(fn ($model) => $model->id))[0],
            'maggot_id' => $this->withFaker()->randomElements(Maggot::all()->map(fn ($model) => $model->id))[0],
            'jumlah' => $this->faker->numberBetween(1, 2),
        ];
    }
}
