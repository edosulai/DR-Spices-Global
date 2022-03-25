<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Spice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Cart::create([
            'user_id' => 1,
            'spice_id' => 1,
            'jumlah' => 2,
        ]);

        $spice = Spice::find(1);
        $spice->stok = $spice->stok - 2;
        $spice->save();

        Cart::factory(9)->create();
    }
}
