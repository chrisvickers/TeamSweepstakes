<?php

namespace App;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sport extends Model
{
    use SoftDeletes;

    /**
     * Table
     * @var string
     */
    protected $table = 'sports';

    /**
     * Fillable
     * @var array
     */
    protected $fillable = array(
        'name',
        'slug'
    );


    protected $with = ['leagues'];


    public static function boot()
    {
        parent::boot();

        static::deleted(function($sport) {

            League::query()->where('sport_id',$sport->id)
                ->delete();

        });
    }

    /**
     * Set Slug and Name Attribute
     * @param $value
     */
    public function setNameAttribute($value){

        $this->attributes['name'] = $value;
        $slugify = str_slug($value);
        $original = $slugify;

        $slug_exists = $this->where('slug',$slugify)->first();
        $counter = 1;
        while ($slug_exists != null){
            $slugify =  $original . $counter;
        }

        $this->attributes['slug'] = $slugify;

    }


    /**
     * A Sport has many Leagues
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leagues()
    {
        return $this->hasMany(League::class);
    }

}
