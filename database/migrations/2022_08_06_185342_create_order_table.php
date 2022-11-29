<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_dummy_order')->default(0);
            $table->mediumText('order_no')->nullable();
            $table->mediumText('payment_mode')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->decimal('total_amount', 8, 2)->default(0);
            $table->decimal('tax_amount', 8, 2)->default(0);
            $table->decimal('amount', 8, 2)->default(0);
            $table->decimal('shipping_amount', 8, 2)->default(0);
            $table->decimal('coupon_amount', 8, 2)->default(0);
            $table->mediumText('coupon_code')->nullable();
            $table->mediumText('billing_details')->nullable();
            $table->mediumText('shipping_details')->nullable();
            $table->dateTime('ordered_at');
            $table->tinyInteger('payment_status')->default(0);
            $table->enum('status', ['1', '2'])->default('1');
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
        Schema::dropIfExists('orders');
    }
}
