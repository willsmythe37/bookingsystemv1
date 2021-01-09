<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->biginteger('Booking_id')->nullable();
            $table->biginteger('Room_id')->nullable();
            $table->string('roomname')->nullable();
            $table->decimal('priceperhour')->nullable();
            $table->biginteger('User_id')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('band')->nullable();
            $table->string('email')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('Booking_start')->nullable();
            $table->datetime('Booking_end')->nullable();
            $table->decimal('Cost_of_booking')->nullable();
            $table->decimal('equiptotal')->nullable();
            $table->boolean('Payment_status')->nullable();
            $table->dateTime('wascreated_at')->nullable();
            $table->datetime('wasupdated_at')->nullable();
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
        Schema::dropIfExists('histories');
    }
}
