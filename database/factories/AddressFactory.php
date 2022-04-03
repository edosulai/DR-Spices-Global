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
            'user_id' => $this->faker->randomElements(User::all()->map(fn ($model) => $model->id))[0],
            'recipent' => $this->faker->name,
            'street' => $this->faker->streetName(),
            'other_street' => $this->faker->streetAddress(),
            'district' => $this->faker->streetSuffix(),
            'city' => $this->faker->city(),
            'state' => $this->faker->citySuffix(),
            'zip' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'phone' => $this->faker->phoneNumber(),
            'primary' => true,
        ];
    }
}
