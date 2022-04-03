<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(2, User::count()),
            'recipent' => $this->faker->name,
            'street' => $this->faker->streetName(),
            'other_street' => $this->faker->streetAddress(),
            'district' => $this->faker->streetSuffix(),
            'city' => $this->faker->city(),
            'state' => $this->faker->citySuffix(),
            'zip' => $this->faker->postcode(),
            // 'country_id' => $this->faker->numberBetween(1, Country::count()),
            'country' => $this->faker->country(),
            'phone' => $this->faker->phoneNumber(),
            'primary' => true,
        ];
    }
}
