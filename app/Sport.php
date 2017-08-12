<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{

    protected $table = 'sports';


    protected $fillable = array(
        'name',
        'slug'
    );




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

}
