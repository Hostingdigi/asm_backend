<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('child_user');
            $table->bigInteger('parent_user');
            $table->decimal('parent_user_discount',8,2)->default(0);
            $table->decimal('child_user_discount',8,2)->default(0);
            $table->decimal('min_spend_value',8,2)->default(0);
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
        Schema::dropIfExists('referral_users');
    }
}
