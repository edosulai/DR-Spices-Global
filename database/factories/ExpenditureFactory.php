<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Expenditure;
use App\Models\Supplier;
use App\Models\Spice;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\expenditure>
 */
class ExpenditureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'supplier_data' => $this->faker->randomElements(Supplier::all()->toArray())[0],
            'spice_data' => $this->faker->randomElements(
                Spice::selectRaw('spices.*, spice_images.image as image')
                    ->join('spice_images', 'spice_images.id', '=', DB::raw("(select id from `spice_images` where `spice_id` = `spices`.`id` order by created_at limit 1)"))
                    ->get()
                    ->toArray()
            )[0],
            'jumlah' => $this->faker->numberBetween(1, 30),
            'created_at' => Carbon::now()->subDay(rand(1, 90)),
            'updated_at' => Carbon::now()->subDay(rand(1, 90))
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Expenditure $expenditure) {
            $spice = Spice::find($expenditure->spice_data['id']);
            $spice->stok = $spice->stok + $expenditure->jumlah;
            $spice->save();
        });
    }
}
