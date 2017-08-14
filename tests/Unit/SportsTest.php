<?php

namespace Tests\Unit;

use App\League;
use App\Sport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SportsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_sport_has_a_league(){

        $sport = factory(Sport::class)->create();

        $this->assertDatabaseHas('sports',$sport->toArray());

        $league = factory(League::class)->create(['sport_id' => $sport->id]);

        $this->assertTrue($sport->leagues->contains(function($leagued) use ($league){
            return $leagued->id == $league->id;
        }));

    }


    /** @test */
    public function a_sport_has_many_leagues(){

        $sport = factory(Sport::class)->create();

        $this->assertDatabaseHas('sports',$sport->toArray());

        $leagues = factory(League::class,5)->create(['sport_id' => $sport->id]);


        $this->assertTrue($sport->leagues->count() == 5);



    }

}
