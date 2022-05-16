<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Postage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Postage::insert([
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AF')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AL')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AS')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AD')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AQ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AW')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AU')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BS')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BH')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BD')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BB')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BY')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BJ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BW')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BV')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BF')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KH')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CV')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KY')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CF')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TD')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CL')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CX')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CC')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CD')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CK')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CU')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CY')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DK')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DJ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'EC')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'EG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SV')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GQ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ER')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'EE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ET')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FK')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FJ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GF')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PF')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TF')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GH')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GL')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GD')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GP')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GU')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GW')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GY')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HK')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HU')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IS')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ID')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IQ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IL')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'JM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'JP')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'JO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KP')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KW')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LV')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LB')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LS')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LY')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LU')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MK')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MW')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MY')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MV')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ML')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MH')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MQ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MU')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'YT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MX')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MD')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MC')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MS')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NP')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NL')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NC')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NU')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NF')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MP')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'OM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PK')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PW')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PS')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PY')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PH')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PL')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'QA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'RE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'RO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'RU')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'RW')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SH')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LC')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VC')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'WS')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ST')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CS')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SC')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SL')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SK')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SB')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ZA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GS')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ES')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LK')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SD')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SJ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CH')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SY')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TW')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TJ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TH')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TL')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TK')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TO')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TT')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TR')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TC')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TV')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UA')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GB')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'US')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UY')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UZ')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VU')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VN')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VG')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VI')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'WF')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'EH')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'YE')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ZM')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ZW')->first()->id,
                'cost' => rand(1, 20) / 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
