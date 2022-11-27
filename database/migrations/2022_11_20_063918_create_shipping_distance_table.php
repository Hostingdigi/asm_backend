<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingDistanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_dist_amounts', function (Blueprint $table) {
            $table->id();
            $table->decimal('from_distance',8,2)->default(0);
            $table->decimal('to_distance',8,2)->default(0)->nullable();
            $table->decimal('amount',8,2)->default(0);
            $table->enum('status', ['0', '1', '2'])->default('1');
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
        Schema::dropIfExists('shipping_dist_amounts');
    }
}
