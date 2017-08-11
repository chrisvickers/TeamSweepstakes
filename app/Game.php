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
        'nickname'
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
        return $this->belongsTo(Team::class,'away_team_id');
    }


    /**
     * A Game has a Away Team
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function homeTeam()
    {
        return $this->belongsTo(Team::class,'home_team_id');
    }

}
