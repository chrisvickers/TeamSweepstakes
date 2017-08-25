<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bet extends Model
{
    use SoftDeletes;


    protected $table = 'bets';


    protected $fillable = array(
        'user_id',
        'game_id',
        'home_team_win',
        'away_team_win',
        'away_team_score',
        'home_team_score'
    );


    protected $with = ['user','game'];


    /**
     * A Bet belongs to a User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * A Bet belongs to a Game
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }


    /**
     * A Bet belongs to an Away Team
     * @return mixed
     */
    public function awayTeam()
    {
        return $this->game->awayTeam;
    }


    /**
     * A Bet belongs to a Home Team
     * @return mixed
     */
    public function homeTeam()
    {
        return $this->game->homeTeam;
    }


    /**
     * A Bet has a Winning Team
     * @return mixed
     */
    public function winningTeam()
    {
        return $this->game->winningTeam();
    }


    /**
     * A Bet has a Losing Team
     * @return mixed
     */
    public function losingTeam()
    {
        return $this->game->losingTeam();
    }




}
