<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSchoolList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tcr_school_list', function (Blueprint $table) {
            $table->string('country');
            $table->string('dist');
            $table->string('school_type');
            $table->string('school_name');
            $table->string('class_num');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tcr_school_list');
    }
}
