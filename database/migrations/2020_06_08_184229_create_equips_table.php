<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equips', function (Blueprint $table) {
            $table->id();
            $table->biginteger('Booking_id')->unsigned();
            $table->foreign('Booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->decimal('guitarheadamount', 8, 0)->nullable();
            $table->decimal('guitarcabamount', 8, 0)->nullable();
            $table->decimal('guitarcomboamount', 8, 0)->nullable();
            $table->decimal('bassheadamount', 8, 0)->nullable();
            $table->decimal('basscabamount', 8, 0)->nullable();
            $table->decimal('basscomboamount', 8, 0)->nullable();
            $table->decimal('drumkitamount', 8, 0)->nullable();
            $table->decimal('cymbalsamount', 8, 0)->nullable();
            $table->decimal('equiptotal')->nullable();
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
        Schema::dropIfExists('equips');
    }
}
