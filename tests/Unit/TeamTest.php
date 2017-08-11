<?php

namespace Tests\Unit;

use App\Game;
use App\Season;
use App\Team;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_team_has_an_away_game(){


        $away_team = factory(Team::class)->create();
        $game = factory(Game::class)->create(['away_team_id' => $away_team->id]);

        $this->assertDatabaseHas('games',$game->toarray());

        $this->assertDatabaseHas('teams',$away_team->toArray());

        $this->assertTrue($away_team->awayGames->contains(function($away_game) use ($game){
            return $away_game->id == $game->id;
        }));

    }



    /** @test */
    public function a_team_has_a_home_game(){


        $home_team = factory(Team::class)->create();
        $game = factory(Game::class)->create(['home_team_id' => $home_team->id]);

        $this->assertDatabaseHas('games',$game->toArray());
        $this->assertDatabaseHas('teams',$home_team->toArray());

        $this->assertTrue($home_team->homeGames->contains(function($home_game) use ($game){
            return $home_game->id == $game->id;
        }));

    }

}
