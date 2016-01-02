<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegisterTimestamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tcr_reg_subject', function (Blueprint $table) {
            $table->dateTime('reg_time');
        });
        Schema::table('tcr_reg_subject_2', function (Blueprint $table) {
            $table->dateTime('reg_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
