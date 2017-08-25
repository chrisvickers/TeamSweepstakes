<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;

    protected $table = 'games';


    protected $fillable = array(
        'game_time',
        'season_id',
        'home_team_id',
        'away_team_id',
        'postponed',
        'home_team_score',
        'away_team_score'
    );


    protected $dates = array(
        'game_time'
    );

    /**
     * A Game belongs to a Season
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
    }


    /**
     * A Game has a Home Team
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function awayTeam()
    {
        return $this->belongsTo(SportsTeam::class,'away_team_id');
    }


    /**
     * A Game has a Away Team
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function homeTeam()
    {
        return $this->belongsTo(SportsTeam::class,'home_team_id');
    }


    /**
     * A Game has many Bets
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bets()
    {
        return $this->hasMany(Bet::class);
    }


    /**
     * Return the Winning Team if there is one
     * @return mixed|null
     */
    public function winningTeam()
    {
        if($this->home_team_score !== $this->away_team_score){
            $winning_team = $this->home_team_score > $this->away_team_score ? 'homeTeam' : 'awayTeam';
            return $this->{$winning_team};
        }
        return null;
    }


    /**
     * Return the Losing Team if there is one
     * @return mixed|null
     */
    public function losingTeam(){
        $winning_team = $this->winningTeam();
        if($winning_team != null){
            return $this->homeTeam->id == $winning_team->id ? $this->awayTeam : $this->homeTeam;
        }
        return null;
    }


}
