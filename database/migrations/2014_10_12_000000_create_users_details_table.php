<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
            $table->string('account_id');
            $table->string('name')->unique();   // Teacher's Real Name
            $table->string('gender');
            $table->string('school');    // Teacher's Classification (Primary or Junior)
            $table->string('phone');
            $table->integer('reg_subject');
            $table->integer('already_pick');
            $table->string('ps');
            $table->integer('priority');
            $table->integer('meat_veg');
            $table->integer('traffic');
            $table->integer('far');
            $table->integer('is_chief');
            $table->integer('chief_assigner');
            $table->integer('reg_verify'); // Whether is verify by email or sms
            $table->rememberToken();
            $table->timestamps('reg_time');    // Register Time
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tcr_users');
    }
}
