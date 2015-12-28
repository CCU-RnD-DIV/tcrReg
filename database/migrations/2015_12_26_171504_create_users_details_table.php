<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcr_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_id')->unique();
            $table->string('name');   // Teacher's Real Name
            $table->string('gender');
            $table->string('school');    // Teacher's Classification (Primary or Junior)
            $table->string('phone');
            $table->rememberToken();
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
        Schema::drop('tcr_details');
    }
}
