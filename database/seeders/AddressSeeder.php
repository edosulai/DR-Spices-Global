<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::insert([
            [
                'user_id' => 1,
                'recipent' => 'Edo Sulaiman',
                'street' => 'Jl. Ikua Koto',
                'other_street' => 'Jorong Ampang Gadang',
                'district' => 'Kec. Ampek Angkek',
                'city' => 'Kab. Agam',
                'state' => 'Sumatera Barat',
                'zip' => '26191',
                // 'country_id' => 1,
                'country' => 'Indonesia',
                'phone' => '+62-823-8600-7722',
                'primary' => true,
            ], [
                'user_id' => 1,
                'recipent' => 'Sutan Sulaiman',
                'street' => 'Toko Ferina 1 Blok F, no 96',
                'other_street' => 'Aur Birugo Tigo Baleh',
                'district' => 'Kec. Ampek Angkek',
                'city' => 'Kota Bukittinggi',
                'state' => 'Sumatera Barat',
                'zip' => '26191',
                // 'country_id' => 1,
                'country' => 'Indonesia',
                'phone' => '+62-851-6118-8255',
                'primary' => false,
            ],
        ]);

        Address::factory(10)->create();
    }
}
