<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('road_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('class_start', 0);
            $table->string('class_end', 0);
            $table->string('class_day', 0);
            $table->Integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->Integer('instructor_id')->unsigned();
            $table->foreign('instructor_id')->references('id')->on('users');
            $table->Integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->Integer('branch_id')->unsigned()->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->Integer('vehical_id')->unsigned();
            $table->foreign('vehical_id')->references('id')->on('vehicals');
            $table->enum('status', ['inactive','active',]);
            $table->enum('course_type', ['theoratical', 'practical']);
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
        Schema::dropIfExists('road_schedules');
    }
}
