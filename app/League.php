<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class League extends Model
{
    use SoftDeletes;

    /**
     * Table
     * @var string
     */
    protected $table = 'leagues';

    /**
     * Fillable
     * @var array
     */
    protected $fillable = array(
        'name',
        'slug',
        'sport_id'
    );


    public static function boot()
    {
        parent::boot();

        static::deleted(function($league){
            SportsTeam::query()->where('league_id',$league->id)->delete();
        });
    }

    /**
     * A League belongs to a sport
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }


    /**
     * A League has many sports teams
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams()
    {
        return $this->hasMany(SportsTeam::class);
    }


    /**
     * A League has many Seasons
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }

}
