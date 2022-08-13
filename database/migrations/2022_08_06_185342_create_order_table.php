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
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('payment_id')->constrained('payments');
            $table->decimal('total_amount', 8, 2)->default(0);
            $table->decimal('tax_amount', 8, 2)->default(0);
            $table->decimal('amount', 8, 2)->default(0);
            $table->decimal('shipping_amount', 8, 2)->default(0);
            $table->decimal('coupon_amount', 8, 2)->default(0);
            $table->mediumText('coupon_code')->nullable();
            $table->mediumText('coupon_code_details')->nullable();
            $table->mediumText('billing_details')->nullable();
            $table->mediumText('shipping_details')->nullable();
            $table->dateTime('ordered_at');
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
