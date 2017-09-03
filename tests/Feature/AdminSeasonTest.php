<?php

namespace Tests\Feature;

use App\Season;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminSeasonTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->adminSetup();
    }


    /** @test */
    public function a_user_cannot_access_seasons()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('admins.seasons.index'))
            ->assertStatus(404);
    }


    /** @test */
    public function an_admin_can_access_seasons()
    {
        $user = $this->adminUser();
        $season = factory(Season::class)->create();

        $this->actingAs($user)->get(route('admins.seasons.index'))
            ->assertSuccessful()
            ->assertSee($season->year);
    }


    /** @test */
    public function an_admin_can_add_a_seasons()
    {
        $user = $this->adminUser();
        $new_season = factory(Season::class)->make();

        $this->actingAs($user)->post(route('admins.seasons.store'),[
            'year'  =>  $new_season->year
        ])->assertRedirect(route('admins.seasons.index'));

        $this->assertDatabaseHas('seasons',[
            'year'  =>  $new_season->year
        ]);
    }

}
