<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metacontents', function (Blueprint $table) {
            $table->id();
            $table->string('charset')->nullable();
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('author')->nullable();
            $table->string('refresh')->nullable();
            $table->string('viewport')->nullable();
            $table->string('title')->nullable();
            $table->string('customCSS', 14500)->nullable();
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
        Schema::dropIfExists('metacontents');
    }
}
