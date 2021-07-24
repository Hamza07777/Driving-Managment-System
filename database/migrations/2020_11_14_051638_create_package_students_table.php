<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->Integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
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
        Schema::dropIfExists('package_students');
    }
}
