<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('car_no')->unique();
            $table->string('number_plate',200)->unique();
            $table->string('manufacturing_company',200);
            $table->string('car_name',200);
            $table->string('model_year',200);
            $table->Integer('branch_id')->unsigned()->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->Integer('instructor_id')->unsigned();
            $table->foreign('instructor_id')->references('id')->on('users');
            $table->string('image');
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
        Schema::dropIfExists('vehicals');
    }
}
