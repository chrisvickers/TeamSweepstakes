<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(\App\Team::class, function(\Faker\Generator $faker){

    return [
        'name'  =>  $faker->name,
        'city'  =>  $faker->city,
        'logo_url' =>  $faker->imageUrl()
    ];
});


$factory->define(\App\Season::class, function(\Faker\Generator $faker){
   return [
       'year'   =>  $faker->year
   ];
});


$factory->define(\App\Game::class, function(\Faker\Generator $faker){
    return [
        'season_id' =>  factory(\App\Season::class)->create()->id,
        'game_time' =>  $faker->dateTime,
        'away_team_id'  =>  function(){
            return factory(\App\Team::class)->create()->id;
        },
        'home_team_id'  =>  function(){
            return factory(\App\Team::class)->create()->id;
        },
    ];
});