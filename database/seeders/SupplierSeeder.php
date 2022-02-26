<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::insert([
            [
                'nama' => 'Sulai',
                'alamat' => 'Jl. Ikua Koto, Jorong Ampang Gadang',
                'telp' => '0823-8600-7722',
            ]
        ]);

        Supplier::factory()->count(100)->create();
    }
}
