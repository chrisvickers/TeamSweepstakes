<?php

namespace Tests\Unit;

use App\Game;
use App\Season;
use App\Week;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WeekTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_week_has_many_seasons(){


        $week = factory(Week::class)->create();

        $seasons = factory(Season::class,5)->create();

        $seasons->each(function($season) use ($week){
           $season->weeks()->attach($week);
        });

        $this->assertTrue($week->seasons->count() == 5);

    }
}
