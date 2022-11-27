<?php

use Illuminate\Database\Seeder;
use App\Models\CommonDatas;

class CreateOrderStatusSeeder extends Seeder
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

        CommonDatas::insert([
            [
                'key' => 'order_status',
                'value_1' => 'Order Confirmed'
            ]
        ]);
    }
}
