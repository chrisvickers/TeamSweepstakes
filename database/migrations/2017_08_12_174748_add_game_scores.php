<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGameScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('games', function (Blueprint $table){
            $table->dropColumn('nickname');

            $table->integer('home_team_score')->nullable()->after('postponed');
            $table->integer('away_team_score')->nullable()->after('postponed');
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
            $table->string('nickname')->nullable();
            $table->dropColumn('home_team_score');
            $table->dropColumn('away_team_score');
        });
    }
}
