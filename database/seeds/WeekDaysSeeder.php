<?php

use App\Models\WeekDaysModel;
use Illuminate\Database\Seeder;

class WeekDaysSeeder extends Seeder
{
    use TruncateTable;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate('delivery_week_days');

        for ($i = 0; $i < 7; $i++) {
            $dayName = jddayofweek($i, 1);
            WeekDaysModel::create([
                'day' => $dayName,
                'status' => !in_array($dayName,['Saturday','Sunday']) ? '0' : '1' 
            ]);
        }
    }
}
