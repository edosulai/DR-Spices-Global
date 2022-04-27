<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Country;
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

        Address::create([
            'user_id' => $admin->id,
            'recipent' => 'Edo Sulaiman',
            'street' => 'Jl. Ikua Koto',
            'other_street' => 'Jorong Ampang Gadang',
            'district' => 'Kec. Ampek Angkek',
            'city' => 'Kab. Agam',
            'state' => 'Sumatera Barat',
            'zip' => '26191',
            'country_id' => Country::where('name', 'INDONESIA')->first()->id,
            'phone' => '+6282386007722',
            'primary' => true,
        ]);

        User::factory(9)->create();
    }
}
