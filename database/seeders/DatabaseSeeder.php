<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(PostageSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MaggotSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ExpenditureSeeder::class);
        $this->call(RequestBuySeeder::class);
        $this->call(CartSeeder::class);
    }
}
