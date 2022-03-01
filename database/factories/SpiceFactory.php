<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spice>
 */
class SpiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->unique()->randomElement(['Cengkeh', 'Coklat', 'Kayu Manis', 'Lada', 'Pala']),
            'hrg_jual' => $this->faker->numberBetween(10000, 20000),
            // 'hrg_jual' => 10000,
            'stok' => 0,
            'ket' => $this->faker->paragraph(),
        ];
    }
}