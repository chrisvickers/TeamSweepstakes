<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SportsTeam extends Model
{

    protected $table = 'sports_teams';


    protected $fillable = array(
        'league_id',
        'name',
        'city',
        'logo_url'
    );


    /**
     * A Team has many Home Games
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function homeGames()
    {
        return $this->hasMany(Game::class,'home_team_id');
    }

    /**
     * A Team has many Away Games
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function awayGames()
    {
        return $this->hasMany(Game::class,'away_team_id');
    }


    /**
     * A Team has many Games
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function games()
    {
        return Game::query()->where('home_team_id',$this->id)
            ->orWhere('away_team_id',$this->id)->get();
    }

    /**
     * A Sport Team belongs to a League
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function league()
    {
        return $this->belongsTo(League::class);
    }

}
