<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $table = 'teams';


    protected $fillable = array(
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
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function games()
    {
        return Game::query()->where('home_team_id',$this->id)
            ->orWhere('away_team_id',$this->id);
    }

}
