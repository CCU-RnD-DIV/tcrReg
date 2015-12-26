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
        Schema::create('tcr_reg_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_id');
            $table->integer('reg_subject');
            $table->integer('already_pick');
            $table->string('ps');
            $table->integer('priority');
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
        Schema::drop('tcr_reg_subject');
    }
}
