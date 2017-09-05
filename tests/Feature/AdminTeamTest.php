<?php

namespace Tests\Feature;


use App\League;
use App\SportsTeam;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTeamTest extends TestCase
{

    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();
        $this->adminSetup();
    }


    /** @test */
    public function an_admin_can_access_teams()
    {
        $user = $this->adminUser();
        $this->actingAs($user)->get(route('admins.teams.index'))
            ->assertSuccessful();
    }


    /** @test */
    public function a_user_cannot_access_teams()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('admins.teams.index'))
            ->assertStatus(404);
    }


    /** @test */
    public function a_user_can_see_teams()
    {
        $user = $this->adminUser();

        SportsTeam::query()->delete();

        $team = factory(SportsTeam::class)->create();
        $this->actingAs($user)->get(route('admins.teams.index'))
            ->assertSuccessful()
            ->assertSee(htmlentities($team->name))
            ->assertSee(htmlentities($team->city));
    }


    /** @test */
    public function a_user_can_create_a_team()
    {
        $user = $this->adminUser();

        $this->actingAs($user)->get(route('admins.teams.create'))
            ->assertSuccessful();

        $team = factory(SportsTeam::class)->make();
        $league = factory(League::class)->create();

        $this->actingAs($user)->post(route('admins.teams.store'),[
            'name'      =>  $team->name,
            'city'      =>  $team->city,
            'league_id' =>  $league->id
        ])->assertRedirect(route('admins.teams.index'));


        $this->assertDatabaseHas('sports_teams',[
            'name'  =>  $team->name,
            'city'  =>  $team->city
        ]);
    }


    /** @test */
    public function a_user_can_edit_a_team()
    {

    }


    /** @test */
    public function a_user_can_destroy_a_team()
    {


    }

}
