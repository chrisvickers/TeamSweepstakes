<?php

namespace Tests\Feature;

use App\League;
use App\Role;
use App\Team;
use App\User;
use Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminLeagueTest extends TestCase
{
    use DatabaseMigrations;


    protected $admin_role, $team;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->admin_role = Role::where('name','admin')->first();
        $this->team = Team::query()->where('name','Super Team')->firstOrCreate([
            'name'  =>  'Super Team'
        ]);
    }


    private function adminUser(){
        $user = factory(User::class)->create();
        $user->roles()->attach($this->admin_role);
        return $user;
    }

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
    public function a_user_can_add_a_league(){


    }


    /** @test */
    public function a_user_can_edit_a_league(){


    }

}
