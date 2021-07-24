<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text',200);
            $table->string('appoinment_start', 0);
            $table->string('appoinment_end', 0);
            $table->string('appoinment_day', 0);
            $table->Integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->Integer('instructor_id')->unsigned();
            $table->foreign('instructor_id')->references('id')->on('users');
            $table->enum('status', ['inactive','active',]);
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
        Schema::dropIfExists('appointments');
    }
}
