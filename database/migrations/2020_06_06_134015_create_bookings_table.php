<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->biginteger('Room_id')->unsigned();
            $table->foreign('Room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->biginteger('User_id')->unsigned();
            $table->foreign('User_id')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('Booking_start');
            $table->datetime('Booking_end');
            $table->decimal('Cost_of_booking');
            $table->boolean('Payment_status');
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
        Schema::dropIfExists('bookings');
    }
}
