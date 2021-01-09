<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHirePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hireprices', function (Blueprint $table) {
            $table->id();
            $table->decimal('guitarhead')->nullable();
            $table->decimal('guitarcab')->nullable();
            $table->decimal('guitarcombo')->nullable();
            $table->decimal('guitarheadstock', 8, 0)->nullable();
            $table->decimal('guitarcabstock', 8, 0)->nullable();
            $table->decimal('guitarcombostock', 8, 0)->nullable();
            $table->decimal('basshead')->nullable();
            $table->decimal('basscab')->nullable();
            $table->decimal('basscombo')->nullable();
            $table->decimal('bassheadstock', 8, 0)->nullable();
            $table->decimal('basscabstock', 8, 0)->nullable();
            $table->decimal('basscombostock', 8, 0)->nullable();
            $table->decimal('drumkit')->nullable();
            $table->decimal('cymbals')->nullable();
            $table->decimal('drumkitstock', 8, 0)->nullable();
            $table->decimal('cymbalsstock', 8, 0)->nullable();
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
        Schema::dropIfExists('hireprices');
    }
}
