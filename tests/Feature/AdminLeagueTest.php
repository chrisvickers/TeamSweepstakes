<?php

namespace Tests\Feature;

use App\League;
use App\Sport;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminLeagueTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function only_an_admin_can_access_leagues(){

        $user = $this->adminUser();
        $user->teams()->attach($this->team);

        $this->actingAs($user)->get(route('admins.leagues.index'))
            ->assertSuccessful();

    }


    /** @test */
    public function a_normal_user_cannot_see_leagues(){

        $user = factory(User::class)->create();

        $user->teams()->attach($this->team);

        $this->actingAs($user)->get(route('admins.leagues.index'))
            ->assertStatus(404);

    }



    /** @test */
    public function can_see_leagues_on_index(){

        $user = $this->adminUser();
        $league = factory(League::class)->create();

        $this->actingAs($user)->get(route('admins.leagues.index'))
            ->assertSee($league->name);


    }


    /** @test */
    public function a_user_cannot_add_a_league_until_there_is_one_sport()
    {

        $user = $this->adminUser();

        $this->actingAs($user)->get(route('admins.leagues.create'))
            ->assertRedirect(route('admins.sports.create'));
    }


    /** @test */
    public function a_user_can_add_a_league(){

        $user = $this->adminUser();
        $sport = factory(Sport::class)->create();

        $this->actingAs($user)->get(route('admins.leagues.create'))
            ->assertSuccessful();

        $league = factory(League::class)->make([
            'sport_id'  =>  $sport->id
        ]);

        $this->actingAs($user)->post(route('admins.leagues.store'),[
            'name'  =>  $league->name,
            'sport_id'  =>  $league->sport_id
        ])->assertRedirect(route('admins.leagues.index'));

        $this->assertDatabaseHas('leagues',$league->toArray());


    }


    /** @test */
    public function a_user_can_edit_a_league(){

        $user = $this->adminUser();
        $league = factory(League::class)->create();

        $this->actingAs($user)->get(route('admins.leagues.edit', ['id' => $league->id]))
            ->assertSuccessful()
            ->assertSee($league->name);

        $new_league = factory(League::class)->make();

        $this->actingAs($user)->patch(route('admins.leagues.update',['id' => $league->id]),[
            'name'  =>  $new_league->name,
            'sport_id'  =>  $league->sport_id
        ])->assertRedirect(route('admins.leagues.index'));

    }

}
