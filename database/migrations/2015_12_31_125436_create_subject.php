<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcr_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id');
            $table->string('subject_name', 10);
            $table->integer('subject_far');
            $table->integer('subject_normal');
            $table->integer('subject_priority');
            $table->integer('subject_type');
            $table->string('subject_prefix', 5);
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
        Schema::drop('tcr_subject');
    }
}
