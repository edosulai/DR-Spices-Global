<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Status::factory(4)->create();
        Status::insert([
            [
                'id' => Str::orderedUuid(),
                'nama' => 'Pending',
                'ket' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, quasi.'
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Accepted',
                'ket' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, quasi.'
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Shipping',
                'ket' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, quasi.'
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Completed',
                'ket' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, quasi.'
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Rated',
                'ket' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, quasi.'
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Rejected',
                'ket' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, quasi.'
            ],
        ]);
    }
}
