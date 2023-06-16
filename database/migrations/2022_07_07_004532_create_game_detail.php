<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_detail', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('product_name');
            $table->integer('price');
            $table->string('game_code');
            $table->timestamps();

            $table->foreign('game_code')->references('game_code')->on('game_list')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_detail');
    }
};
