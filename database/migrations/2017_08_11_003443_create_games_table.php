<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('game_time');
            $table->unsignedInteger('season_id');
            $table->unsignedInteger('home_team_id');
            $table->unsignedInteger('away_team_id');
            $table->boolean('postponed')->default(0);
            $table->string('nickname')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('home_team_id')->references('id')->on('games');
            $table->foreign('away_team_id')->references('id')->on('games');
            $table->foreign('season_id')->references('id')->on('seasons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
