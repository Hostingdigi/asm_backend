<?php

use App\Models\CommonDatas;
use Illuminate\Database\Seeder;

class FreeShippingSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate('common_datas');

        CommonDatas::create([
            'key' => 'free-shipping-config',
            'value_1' => 100,
        ]);
    }
}
