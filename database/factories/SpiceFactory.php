<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
            'nama' => $this->faker->name(),
            'hrg_beli' => $this->faker->numberBetween(10000, 20000),
            'hrg_jual' => $this->faker->numberBetween(10000, 20000),
            'stok' => $this->faker->numberBetween(50, 100),
            'tgl_masuk' => Carbon::now()->format('Y-m-d'),
            'spek' => json_encode([
                'asal' => $this->faker->city(),
                'kelembaban' => "Max " . $this->faker->numberBetween(5,10) . "%",
                'abu' => "Max " . $this->faker->numberBetween(1,3) . "%",
                'bentuk' => $this->faker->paragraph()
            ]),
        ];
    }
}
