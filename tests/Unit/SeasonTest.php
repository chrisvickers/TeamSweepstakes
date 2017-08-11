<?php

namespace Tests\Unit;

use App\Game;
use App\Season;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SeasonTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_season_has_many_games()
    {
        $season = factory(Season::class)->create();

        $games = factory(Game::class)->create(['season_id' => $season->id]);

        $this->assertDatabaseHas('seasons',$season->toArray());

        $this->assertTrue($season->games->contains(function ($gamed) use ($games){
            return $games->id == $gamed->id;
        }));
    }
}
