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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->string('reference_number');
            $table->string('game_code');
            $table->bigInteger('game_detail_id')->unsigned();
            $table->string('buyer_game_id');
            $table->integer('amount');
            $table->bigInteger('payment_method_id')->unsigned();
            $table->string('email');
            $table->integer('status');
            $table->integer('user_id');
            $table->timestamps();

            $table->foreign('game_detail_id')->references('id')->on('game_detail')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_method')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('transaction');
    }
};
