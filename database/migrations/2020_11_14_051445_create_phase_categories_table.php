<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhaseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phase_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phase_categories_name',200);
            $table->string('detail',200);
            $table->Integer('branche_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('branches');
            $table->Integer('course_id')->unsigned();
            $table->foreign('branche_id')->references('id')->on('courses');
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
        Schema::dropIfExists('phase_categories');
    }
}
