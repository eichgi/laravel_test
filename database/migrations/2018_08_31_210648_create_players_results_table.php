<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('result_id');
            $table->unsignedInteger('player_id');
            $table->foreign('result_id')->references('id')->on('results');
            $table->foreign('player_id')->references('id')->on('players');
            $table->integer('goals');
            $table->integer('red_cards');
            $table->integer('yellow_cards');
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
        Schema::dropIfExists('players_results');
    }
}
