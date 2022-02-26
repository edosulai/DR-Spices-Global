<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expenditure;
use Illuminate\Support\Carbon;

class ExpenditureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expenditure::insert([
            [
                'supplier_id' => 1,
                'faktur' => 'FAK.012345',
                'spice_id' => 1,
                'jumlah' => 2,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'ket' => '',
            ]
        ]);

        Expenditure::factory()->count(500)->create();
    }
}
