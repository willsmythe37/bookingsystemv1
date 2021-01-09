<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitecontents', function (Blueprint $table) {
            $table->id();
            $table->string('pagename')->nullable();
            $table->string('title1')->nullable();
            $table->text('body1', 10000)->nullable();
            $table->boolean('show1')->nullable();
            $table->string('image1')->nullable();
            $table->boolean('showimage1')->nullable();
            $table->string('title2')->nullable();
            $table->text('body2', 10000)->nullable();
            $table->boolean('show2')->nullable();
            $table->string('image2')->nullable();
            $table->boolean('showimage2')->nullable();
            $table->string('title3')->nullable();
            $table->text('body3', 10000)->nullable();
            $table->boolean('show3')->nullable();
            $table->string('image3')->nullable();
            $table->boolean('showimage3')->nullable();
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
        Schema::dropIfExists('sitecontents');
    }
}
