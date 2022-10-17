<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_datas', function (Blueprint $table) {
            $table->id();
            $table->mediumText('key');
            $table->mediumText('value_1')->nullable();
            $table->mediumText('value_2')->nullable();
            $table->mediumText('value_3')->nullable();
            $table->mediumText('value_4')->nullable();
            $table->mediumText('value_5')->nullable();
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
        Schema::dropIfExists('common_datas');
    }
}
