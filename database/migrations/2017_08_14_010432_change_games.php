<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_week', function(Blueprint $table){
            $table->increments('id');
            $table->unSignedinteger('season_id');
            $table->unsignedInteger('week_id');

            $table->foreign('season_id')->references('id')->on('seasons');
            $table->foreign('week_id')->references('id')->on('weeks');
        });


        Schema::table('games', function (Blueprint $table){
           $table->dropColumn('game_time');
           $table->integer('day_of_week')->after('id');
           $table->unsignedInteger('week_id')->after('postponed');

           $table->foreign('week_id')->references('id')->on('weeks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table){
            $table->dropForeign('games_week_id_foreign');
            $table->dropColumn('week_id');
        });

        Schema::table('games', function (Blueprint $table){
            $table->dropColumn('day_of_week');
            $table->dateTime('game_time')->after('id')->nullable();
        });

        Schema::dropIfExists('season_week');
    }
}
