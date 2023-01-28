<?php

use App\Models\CommonDatas;
use Illuminate\Database\Seeder;

class CommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $appHomepageBannerData = collect([
            'key' => 'app-homepage-banner',
            'value_1' => 'images/noimage.png',
            'value_2' => '',
            'status' => '1',
        ]);
        // Check home page banner data
        if (!CommonDatas::where($appHomepageBannerData->only(['key', 'status'])->toArray())->exists()) {
            CommonDatas::create($appHomepageBannerData->except(['status'])->toArray());
        }

        $bannerRedirects = [
            'coupon_list',            
        ];

        print_r($bannerRedirects);*/
    }
}
