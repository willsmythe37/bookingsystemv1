<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinesshoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesshours', function (Blueprint $table) {
            $table->id();
            $table->time('Mondaystart')->nullable();
            $table->time('Mondayend')->nullable();
            $table->time('Tuesdaystart')->nullable();
            $table->time('Tuesdayend')->nullable();
            $table->time('Wednesdaystart')->nullable();
            $table->time('Wednesdayend')->nullable();
            $table->time('Thursdaystart')->nullable();
            $table->time('Thursdayend')->nullable();
            $table->time('Fridaystart')->nullable();
            $table->time('Fridayend')->nullable();
            $table->time('Saturdaystart')->nullable();
            $table->time('Saturdayend')->nullable();
            $table->time('Sundaystart')->nullable();
            $table->time('Sundayend')->nullable();
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
        Schema::dropIfExists('businesshours');
    }
}
