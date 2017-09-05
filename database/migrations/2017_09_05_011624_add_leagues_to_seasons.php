<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeaguesToSeasons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('league_season')){
            Schema::create('league_season', function (Blueprint $table){
                $table->increments('id');
                $table->unsignedInteger('season_id');
                $table->unsignedInteger('league_id');
                $table->foreign('season_id')->references('id')->on('seasons');
                $table->foreign('league_id')->references('id')->on('leagues');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues_seasons');
    }
}
