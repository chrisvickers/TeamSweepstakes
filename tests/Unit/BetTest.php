<?php

namespace Tests\Unit;

use App\Bet;
use App\Game;
use App\SportsTeam;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BetTest extends TestCase
{
    use DatabaseMigrations;



    /** @test */
    public function a_bet_belongs_to_a_user(){

        $user = factory(User::class)->create();

        $bet = factory(Bet::class)->create(['user_id' => $user->id]);


        $this->assertTrue($user->bets->contains(function($user_bet) use ($bet){
            return $user_bet->id == $bet->id;
        }));

    }



    /** @test */
    public function a_bet_belongs_to_a_game(){

        $game = factory(Game::class)->create();

        $bet = factory(Bet::class)->create(['game_id'   =>  $game->id]);


        $this->assertTrue($game->bets->contains(function($game_bet) use ($bet){
            return $game_bet->id == $bet->id;
        }));

    }


    /** @test */
    public function a_bet_belongs_to_an_away_team(){

        $away_team = factory(SportsTeam::class)->create();
        $game = factory(Game::class)->create(['away_team_id' => $away_team->id]);

        $bet = factory(Bet::class)->create(['game_id' => $game->id]);

        $this->assertTrue($bet->awayTeam()->id == $away_team->id);

    }



    /** @test */
    public function a_bet_belongs_to_a_home_team(){

        $home_team = factory(SportsTeam::class)->create();
        $game = factory(Game::class)->create(['home_team_id' => $home_team->id]);

        $bet = factory(Bet::class)->create(['game_id' => $game->id]);

        $this->assertTrue($bet->homeTeam()->id == $home_team->id);

    }



    /** @test */
    public function a_bet_has_a_winning_team(){

        $winning_team = factory(SportsTeam::class)->create();
        $game = factory(Game::class)->create(['home_team_id' => $winning_team->id,'home_team_score' => 20, 'away_team_score' => 10]);

        $bet = factory(Bet::class)->create(['game_id' => $game->id]);

        $this->assertTrue($bet->winningTeam()->id == $winning_team->id);

    }


    /** @test */
    public function a_bet_has_a_loser(){

        $losing_team = factory(SportsTeam::class)->create();
        $game = factory(Game::class)->create(['home_team_id' => $losing_team->id, 'home_team_score' => 10, 'away_team_score' => 30]);

        $bet = factory(Bet::class)->create(['game_id' => $game->id]);

        $this->assertTrue($bet->losingTeam()->id == $losing_team->id);

    }



    public function a_bet_has_a_list_of_users_who_won(){


    }


    public function a_bet_has_a_list_of_users_who_lost(){


    }



    public function did_a_user_win_this_bet(){


    }
}
