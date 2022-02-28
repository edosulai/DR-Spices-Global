<?php

namespace Database\Seeders;

use App\Models\RequestBuy;
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
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SpiceSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ExpenditureSeeder::class);
        $this->call(IncomeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(RequestBuySeeder::class);
    }
}
