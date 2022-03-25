<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Spice;
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
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'spice_id' => $this->faker->numberBetween(1, Spice::count()),
            'jumlah' => $this->faker->numberBetween(1, 2),
        ];
    }
    
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Cart $cart) {
            $spice = Spice::find($cart->spice_id);
            $spice->stok = $spice->stok - $cart->jumlah;
            $spice->save();
        });
    }
}
