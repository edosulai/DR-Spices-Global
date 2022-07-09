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
            'email' => 'admin@drspicesglobal.com',
            'password' => bcrypt('zzSa6e8UAbnu')
        ]);

        $admin->markEmailAsVerified();

        $admin->assignRole('admin');

        Address::create([
            'user_id' => $admin->id,
            'recipent' => 'DANI AFRIANTO',
            'street' => 'Jl. Raya Bukittingi - Payakumbuh KM.13',
            'other_street' => 'Jorong Baso',
            'district' => 'Kec. Ampek Angkek',
            'city' => 'Kab. Agam',
            'state' => 'Sumatera Barat',
            'zip' => '26192',
            'country_id' => Country::where('name', 'INDONESIA')->first()->id,
            'phone' => '+628-576-080-0434',
            'primary' => true,
        ]);

        // User::factory(9)->create();
    }
}
