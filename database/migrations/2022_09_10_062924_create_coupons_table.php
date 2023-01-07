<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->enum('nature', ['general', 'referral', 'user'])->default('general');
            $table->enum('coupon_type', ['percentage', 'amount'])->default('percentage');
            $table->mediumText('vendor_customization')->nullable();
            $table->mediumText('title');
            $table->mediumText('code');
            $table->mediumText('image')->nullable();
            $table->decimal('offer_value', 8, 2);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->mediumText('description')->nullable();
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon');
    }
}
