<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
use Illuminate\Support\Carbon;
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
        Status::insert([
            [
                'id' => Str::orderedUuid(),
                'nama' => 'Order Placed',
                'icon' => 'fas fa-receipt',
                'created_at' => Carbon::now()->subSecond(9),
                'updated_at' => Carbon::now()->subSecond(9)
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Order Paid',
                'icon' => 'fas fa-file-invoice-dollar',
                'created_at' => Carbon::now()->subSecond(8),
                'updated_at' => Carbon::now()->subSecond(8)
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Accepted',
                'icon' => 'fa fa-check',
                'created_at' => Carbon::now()->subSecond(7),
                'updated_at' => Carbon::now()->subSecond(7)
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Picked by Courier',
                'icon' => 'fa fa-user',
                'created_at' => Carbon::now()->subSecond(6),
                'updated_at' => Carbon::now()->subSecond(6)
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'In Transit',
                'icon' => 'fa fa-truck',
                'created_at' => Carbon::now()->subSecond(5),
                'updated_at' => Carbon::now()->subSecond(5)
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Delivered',
                'icon' => 'fa fa-box',
                'created_at' => Carbon::now()->subSecond(4),
                'updated_at' => Carbon::now()->subSecond(4)
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Rated',
                'icon' => 'fas fa-star',
                'created_at' => Carbon::now()->subSecond(3),
                'updated_at' => Carbon::now()->subSecond(3)
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Rejected',
                'icon' => 'fas fa-ban',
                'created_at' => Carbon::now()->subSecond(2),
                'updated_at' => Carbon::now()->subSecond(2)
            ], [
                'id' => Str::orderedUuid(),
                'nama' => 'Canceled',
                'icon' => 'fas fa-window-close',
                'created_at' => Carbon::now()->subSecond(1),
                'updated_at' => Carbon::now()->subSecond(1)
            ],
        ]);
    }
}
