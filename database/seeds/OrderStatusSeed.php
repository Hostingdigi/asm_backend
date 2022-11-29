<?php

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeed extends Seeder
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
                'status_code' => 0,
                'label' => 'Payment awaiting'
            ],
            [
                'status_code' => 1,
                'label' => ''
            ],
            [
                'status_code' => 2,
                'label' => ''
            ],
            [
                'status_code' => 3,
                'label' => ''
            ],
            [
                'status_code' => 4,
                'label' => ''
            ],
            [
                'status_code' => 5,
                'label' => ''
            ],
            [
                'status_code' => 6,
                'label' => ''
            ],
        ]);
    }
}
