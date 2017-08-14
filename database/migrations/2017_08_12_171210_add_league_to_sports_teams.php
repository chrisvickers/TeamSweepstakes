<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeagueToSportsTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sports_teams', function (Blueprint $table){
            if(!Schema::hasColumn('sports_teams','league_id')){
                $table->unsignedInteger('league_id')->after('id');
                $table->foreign('league_id')->references('id')->on('leagues');
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sports_teams', function (Blueprint $table){
            $table->dropForeign('sports_teams_league_id_foreign');
            $table->dropColumn('league_id');
        });
    }
}
