<?php

use App\Models\CommonDatas;
use Illuminate\Database\Seeder;

class AddressTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommonDatas::where('key', 'address_types')->delete();
        CommonDatas::insert([
            [
                'key' => 'address_types',
                'value_1' => 'home',
                'value_2' => 'Home',
                'value_3' => 1,
            ],
            [
                'key' => 'address_types',
                'value_1' => 'office',
                'value_2' => 'Office',
                'value_3' => 2,
            ],
            [
                'key' => 'address_types',
                'value_1' => 'other',
                'value_2' => 'Other',
                'value_3' => 3,
            ],
        ]);
    }
}
