<?php

namespace Tests\Unit;

use App\Team;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{

    /** @test */
    public function a_team_has_many_games(){


        $team = factory(Team::class)->create();
        dd($team);


    }

}
