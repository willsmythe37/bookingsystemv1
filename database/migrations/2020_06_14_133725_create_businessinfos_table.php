<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businessinfos', function (Blueprint $table) {
            $table->id();
            $table->integer('copyrightyear')->nullable();
            $table->string('phonenumber', 30)->nullable();
            $table->string('emailaddress', 30)->nullable();
            $table->string('businessname', 30)->nullable();
            $table->string('housenumber', 30)->nullable();
            $table->string('streetname', 30)->nullable();
            $table->string('town', 30)->nullable();
            $table->string('county', 30)->nullable();
            $table->string('postcode', 30)->nullable();
            $table->string('image1')->nullable();
            $table->boolean('showimage1')->nullable();
            $table->string('emailnotifications', 50)->nullable();
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
        Schema::dropIfExists('businessinfos');
    }
}
