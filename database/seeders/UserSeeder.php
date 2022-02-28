<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Edo Sulai',
            'email' => 'ngufeel@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $admin->assignRole('admin');

        User::factory(19)->create();
    }
}
