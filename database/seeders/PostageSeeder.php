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
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AL')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AS')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AD')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AQ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AW')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AU')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BS')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BH')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BD')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BB')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BY')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BJ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BW')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BV')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BF')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'BI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KH')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CV')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KY')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CF')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TD')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CL')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CX')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CC')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CD')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CK')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CU')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CY')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DK')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DJ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'EC')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'EG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SV')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GQ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ER')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'EE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ET')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FK')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FJ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GF')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PF')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TF')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'DE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GH')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GL')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GD')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GP')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GU')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GW')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GY')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HK')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'HU')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IS')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ID')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IQ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IL')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'IT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'JM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'JP')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'JO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KP')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KW')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LV')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LB')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LS')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LY')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LU')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MK')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MW')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MY')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MV')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ML')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MH')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MQ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MU')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'YT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MX')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'FM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MD')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MC')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MS')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NP')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NL')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NC')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NU')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NF')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'MP')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'NO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'OM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PK')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PW')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PS')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PY')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PH')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PL')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'QA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'RE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'RO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'RU')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'RW')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SH')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'KN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LC')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'PM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VC')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'WS')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ST')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CS')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SC')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SL')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SK')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SB')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ZA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GS')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ES')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'LK')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SD')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SJ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'CH')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'SY')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TW')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TJ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TH')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TL')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TK')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TO')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TT')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TR')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TC')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'TV')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UA')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'AE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'GB')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'US')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UY')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'UZ')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VU')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VN')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VG')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'VI')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'WF')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'EH')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'YE')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ZM')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => Str::orderedUuid(),
                'country_id' => Country::where('iso', 'ZW')->first()->id,
                'cost' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
