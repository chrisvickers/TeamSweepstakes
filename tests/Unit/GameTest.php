<?php

namespace Tests\Unit;

use App\Game;
use App\Season;
use App\SportsTeam;
use App\Team;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GameTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_game_belongs_to_a_season(){

        $season = factory(Season::class)->create();

        $game = factory(Game::class)->create(['season_id' => $season->id]);

        $this->assertDatabaseHas('games',$game->toArray());

        $this->assertTrue($game->season->id == $season->id);

    }

    /** @test */
    public function a_game_belongs_to_a_away_team(){


        $away_team = factory(SportsTeam::class)->create();

        $game = factory(Game::class)->create(['away_team_id' => $away_team->id]);


        $this->assertDatabaseHas('games',$game->toArray());

        $this->assertTrue($game->awayTeam->id == $away_team->id);

    }

    /** @test */
    public function a_game_belongs_to_a_home_team(){


        $home_team = factory(SportsTeam::class)->create();

        $game = factory(Game::class)->create(['home_team_id' => $home_team->id]);

        $this->assertDatabaseHas('games',$game->toArray());

        $this->assertTrue($game->homeTeam->id == $home_team->id);

    }


    /** @test */
    public function a_game_has_a_winning_team(){

        $winning_team = factory(SportsTeam::class)->create();
        $game = factory(Game::class)->create(['home_team_id' => $winning_team->id, 'home_team_score' => 30, 'away_team_score' => 10]);

        $this->assertTrue($game->winningTeam()->id == $winning_team->id);

    }


    /** @test */
    public function a_game_has_a_losing_team(){


        $losing_team = factory(SportsTeam::class)->create();
        $game = factory(Game::class)->create(['home_team_id' => $losing_team->id, 'home_team_score' => 10, 'away_team_score' => 30]);

        $this->assertTrue($game->losingTeam()->id == $losing_team->id);

    }
}
