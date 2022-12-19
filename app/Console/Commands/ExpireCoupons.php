<?php

namespace App\Console\Commands;

use App\Models\CartCoupon;
use App\Models\Coupon;
use Illuminate\Console\Command;

class ExpireCoupons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:coupons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fetchCoupons = Coupon::where([['status', '=', '1'], ['nature', '=', 'general']])
            ->where('end_date', '<=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'))
            ->get()->pluck('id');

        if (!empty($fetchCoupons)) {
            //Change coupon status
            Coupon::whereIn('id', $fetchCoupons)->update([
                'status' => '2',
            ]);
            //Delete cart coupons
            CartCoupon::whereIn('coupon_id', $fetchCoupons)->delete();
        }
    }
}
