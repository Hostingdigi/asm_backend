<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DeliveryDaysModel;
use Log;

class RemoveOldDeliveryBlockDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:deliolddates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old delivery block dates from DB';

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
        Log::info('COMMAND START('.\Carbon\Carbon::now()->format('d-m-Y h:i:s A').'): '.$this->signature.'.');
        $deliveryDateBlockResults = DeliveryDaysModel::where([['status', '=', '1']])
            ->where('day_date', '<=', \Carbon\Carbon::now()->format('Y-m-d'))
            ->delete();
        Log::info('COMMAND END('.\Carbon\Carbon::now()->format('d-m-Y h:i:s A').'): '.$this->signature.'.');
    }
}
