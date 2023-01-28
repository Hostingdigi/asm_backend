<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->mediumText('address_type')->default('other');
            $table->mediumText('address_type_label')->nullable();
            $table->mediumText('name')->nullable();
            $table->mediumText('email_address')->nullable();
            $table->mediumText('mobile')->nullable();
            $table->mediumText('address');
            $table->mediumText('city');
            $table->integer('zipcode');
            $table->mediumText('state');
            $table->integer('country_id');
            $table->mediumText('latitude')->nullable();
            $table->mediumText('longitude')->nullable();
            $table->mediumText('formatted_address')->nullable();
            $table->mediumText('place_id')->nullable();
            $table->enum('status',['0','1','2'])->default('1')->comment('0 is deactive, 1 is active, 2 is removed');
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
        Schema::dropIfExists('cart_address');
    }
}
