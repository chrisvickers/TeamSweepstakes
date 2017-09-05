<?php

namespace Tests\Feature;

use App\Season;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminGamesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->adminSetup();
    }


    /** @test */
    public function a_user_cannot_access_admin_games()
    {

        $user = factory(User::class)->create();
        $user->teams()->attach($this->team);

        $this->actingAs($user)->get(route('admins.games.index'))
            ->assertStatus(404);
    }


    /** @test */
    public function an_admin_can_access_admin_games()
    {
        $user = $this->adminUser();

        $game = factory(Season::class)->create();

        $this->actingAs($user)->get(route('admins.games.index'))
            ->assertSuccessful();
    }


    /** @test */
    public function an_admin_can_access_create_games()
    {
        $user = $this->adminUser();
        $this->actingAs($user)->get(route('admins.games.create'))
            ->assertSuccessful();


    }

}
