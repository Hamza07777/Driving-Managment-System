<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('Company_Name')->nullable();
            $table->string('Company_Email')->nullable();
            $table->string('Company_Phone')->nullable();
             $table->string('logo')->nullable();
            $table->string('Company_Website')->nullable();
            $table->string('Company_Address')->nullable();
            $table->string('language')->nullable();
            $table->string('date_format')->nullable();
            
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
        Schema::dropIfExists('settings');
    }
}
