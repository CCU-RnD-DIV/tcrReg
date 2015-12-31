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
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('pid')->unique();
            //$table->string('pwd_alter', 60);
            $table->string('type');
            $table->string('verify_code', 6);
            $table->integer('reg_verify');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('reg_time');
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
