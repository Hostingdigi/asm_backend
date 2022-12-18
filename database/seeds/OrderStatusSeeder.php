<?php

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::insert([
            [
                'status_code' => 1,
                'label' => 'Order Created',
                'description' => '',
                'status' => '0',
                'sort_by' => 0
            ],
            [
                'status_code' => 2,
                'label' => 'Order Cancelled',
                'description' => '',
                'status' => '0',
                'sort_by' => 1
            ],
            [
                'status_code' => 3,
                'label' => 'Order Confirmed',
                'description' => '',
                'status' => '1',
                'sort_by' => 1
            ],
            [
                'status_code' => 4,
                'label' => 'Shipped',
                'description' => '',
                'status' => '1',
                'sort_by' => 2
            ],
            [
                'status_code' => 5,
                'label' => 'Out for Delivery',
                'description' => '',
                'status' => '1',
                'sort_by' => 3
            ],
            [
                'status_code' => 6,
                'label' => 'Delivered',
                'description' => '',
                'status' => '1',
                'sort_by' => 4
            ],
            [
                'status_code' => 7,
                'label' => 'Refund Intiated',
                'description' => '',
                'status' => '0',
                'sort_by' => 0
            ],
            [
                'status_code' => 8,
                'label' => 'Refund Completed',
                'description' => '',
                'status' => '0',
                'sort_by' => 0
            ],
            [
                'status_code' => 9,
                'label' => 'Failed',
                'description' => '',
                'status' => '0',
                'sort_by' => 0
            ],
        ]);
    }
}
