<?php

namespace Database\Factories;

use App\Models\Maggot;
use App\Models\MaggotImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maggot>
 */
class MaggotFactory extends Factory
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
            'hrg_jual' => $this->faker->randomFloat(2, 1, 2),
            'stok' => 0,
            'unit' => 'KG',
            'ket' => $this->faker->paragraph(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Maggot $maggot) {
            $maggots = [];
            for ($i = 0; $i < 4; $i++) {

                // $name = md5(uniqid(empty($_SERVER['SERVER_ADDR']) ? '' : $_SERVER['SERVER_ADDR'], true));
                // $filename = $name . '.png';

                // $fp = fopen('public/storage/images/product' . DIRECTORY_SEPARATOR . $filename, 'w');
                // // $ch = curl_init($this->faker->imageUrl(600, 600, null, true, $maggot->nama, true));
                // $ch = curl_init('http://via.placeholder.com/600x600.png');
                // curl_setopt($ch, CURLOPT_FILE, $fp);
                // curl_exec($ch);
                // fclose($fp);
                // curl_close($ch);

                $maggots[] = [
                    'id' => Str::orderedUuid(),
                    'maggot_id' => $maggot->id,
                    // 'image' => $this->faker->image('public/storage/images/product', 600, 600, null, false, true, $maggot->nama, true),
                    // 'image' => $filename,
                    'image' => $this->faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg']),
                    'created_at' => $maggot->created_at,
                    'updated_at' => $maggot->updated_at
                ];
            }
            MaggotImage::Insert($maggots);
        });
    }
}
