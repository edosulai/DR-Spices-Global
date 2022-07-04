<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Expenditure;
use App\Models\Supplier;
use App\Models\Maggot;
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
            'maggot_data' => $this->faker->randomElements(
                Maggot::selectRaw('maggots.*, maggot_images.image as image')
                    ->join('maggot_images', 'maggot_images.id', '=', DB::raw("(select id from `maggot_images` where `maggot_id` = `maggots`.`id` order by created_at limit 1)"))
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
            $maggot = Maggot::find($expenditure->maggot_data['id']);
            $maggot->stok = $maggot->stok + $expenditure->jumlah;
            $maggot->save();
        });
    }
}
