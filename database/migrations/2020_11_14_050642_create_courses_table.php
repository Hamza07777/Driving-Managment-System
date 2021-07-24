<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_name',200);
            $table->Integer('price');
            $table->string('time_period');
            $table->Integer('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->Integer('instructor_id')->unsigned()->nullable();
            $table->foreign('instructor_id')->references('id')->on('users');
            $table->enum('course_type', ['theoratical', 'practical']);
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
        Schema::dropIfExists('courses');
    }
}
