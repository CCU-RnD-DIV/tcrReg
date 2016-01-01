<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create2ndRegisterData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcr_reg_subject_2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_id');
            $table->integer('reg_subject_2');
            $table->integer('already_pick_2');
            $table->string('ps');
            $table->integer('priority');
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
        Schema::drop('tcr_reg_subject_2');
    }
}
