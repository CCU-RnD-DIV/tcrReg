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
        Schema::create('tcr_users', function (Blueprint $table) {
            $table->increments('tcr_user_id');
            $table->string('tcr_user_email')->unique();;
            $table->string('tcr_user_pwd', 60);
            //$table->string('tcr_user_pwd_alter', 60);
            $table->string('tcr_user_type');
            $table->integer('tcr_user_reg_verify');
            $table->rememberToken();
            $table->timestamps('tcr_user_reg_time');
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
