<?php

namespace Tests\Feature;


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


    }


    /** @test */
    public function a_user_can_create_a_team()
    {


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
