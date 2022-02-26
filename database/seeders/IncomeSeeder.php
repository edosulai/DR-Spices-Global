<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Income;
use Illuminate\Support\Carbon;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Income::insert([
            [
                'user_id' => 1,
                'faktur' => 'FAK.012345',
                'spice_id' => 1,
                'jumlah' => 2,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'ket' => 'pas',
            ]
        ]);

        Income::factory()->count(400)->create();
    }
}
