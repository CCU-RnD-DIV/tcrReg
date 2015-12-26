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
        Schema::create('tcr_habits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_id');
            $table->integer('meat_veg');
            $table->integer('traffic');
            $table->rememberToken();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tcr_habits');
    }
}
