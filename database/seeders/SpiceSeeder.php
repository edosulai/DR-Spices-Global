<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Spice;
use Illuminate\Support\Carbon;

class SpiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Spice::insert([
            [
                'nama' => 'Cengkeh',
                'hrg_beli' => 12000,
                'hrg_jual' => 14000,
                'stok' => 100,
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'spek' => json_encode([
                    'asal' => 'Java, Sumatra',
                    'kelembaban' => 'Max 10%',
                    'abu' => 'Max 3%',
                    'bentuk' => 'Tongkat Kering yang Dibersihkan 30-60 mm'
                ]),
            ]
        ]);

        Spice::factory()->count(200)->create();
    }
}
