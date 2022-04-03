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
            'stok' => 0,
            'unit' => 'KG',
            // 'image' => $this->faker->image('public/storage/images/product', 600, 600, null, false),
            'image' => $this->faker->unique()->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg']),
            'ket' => $this->faker->paragraph(),
        ];
    }
}
