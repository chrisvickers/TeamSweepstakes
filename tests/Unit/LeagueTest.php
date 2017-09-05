<?php

namespace Tests\Unit;

use App\League;
use App\Season;
use App\Sport;
use App\SportsTeam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LeagueTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_league_belongs_to_a_sport(){

        $sport = factory(Sport::class)->create();

        $league = factory(League::class)->create(['sport_id' => $sport->id]);

        $this->assertTrue($league->sport->id == $sport->id);

    }



    /** @test */
    public function a_league_has_many_sports_teams(){


        $league = factory(League::class)->create();

        $sport_teams = factory(SportsTeam::class,5)->create(['league_id' => $league->id]);


        $this->assertTrue($league->teams->count() == 5);

    }


    /** @test */
    public function a_league_contains_a_season()
    {

        $league = factory(League::class)->create();
        $season = factory(Season::class)->create();

        $league->seasons()->attach($season);


        $this->assertTrue($league->seasons->contains(function($seasoned) use ($season){
            return $seasoned->id == $season->id;
        }));

    }

}
