<?php

namespace Tests\Feature;

use App\Sport;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminSportTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->adminSetup();
    }

    /** @test */
    public function a_user_cannot_access_this_page()
    {
        $user = factory(User::class)->create();
        $user->teams()->attach($this->team);
        $this->actingAs($user)->get(route('admins.sports.index'))
            ->assertStatus(404);
    }


    /** @test */
    public function an_admin_can_access_this_page()
    {
        $user = $this->adminUser();
        $this->actingAs($user)->get(route('admins.sports.index'))
            ->assertSuccessful();
    }


    /** @test */
    public function a_user_can_see_sports()
    {
        $user = $this->adminUser();
        $sport = factory(Sport::class)->create();

        $this->actingAs($user)->get(route('admins.sports.index'))
            ->assertSuccessful()
            ->assertSee(htmlentities($sport->name));
    }


    /** @test */
    public function a_user_can_add_a_sport()
    {
        $user = $this->adminUser();
        $sport = factory(Sport::class)->make();


        $this->actingAs($user)->post(route('admins.sports.store'),[
            'name'  =>  $sport->name
        ])->assertRedirect(route('admins.sports.index'));

        $this->assertDatabaseHas('sports',[
            'name'  =>  $sport->name
        ]);

    }


    /** @test */
    public function a_user_can_edit_a_sport()
    {

        $user = $this->adminUser();
        $sport = factory(Sport::class)->create();
        $new_sport = factory(Sport::class)->make();

        $this->actingAs($user)->get(route('admins.sports.edit', array('id' => $sport->id)))
            ->assertSuccessful()
            ->assertSee($sport->name);


        $this->actingAs($user)->patch(route('admins.sports.update', array('id' => $sport->id)),[
            'name'  =>  $new_sport->name
        ])->assertRedirect(route('admins.sports.index'));

        $this->assertDatabaseHas('sports',[
            'name'  =>  $new_sport->name
        ]);

    }


    /** @test */
    public function a_user_can_delete_a_sport()
    {

        $user = $this->adminUser();
        $sport = factory(Sport::class)->create();

        $this->actingAs($user)->delete(route('admins.sports.destroy',['id' => $sport->id]))
            ->assertRedirect(route('admins.sports.index'));


        $this->assertDatabaseHas('sports',[
            'id'    =>  $sport->id,
        ]);

        $sport = Sport::withTrashed()->find($sport->id);
        $this->assertTrue($sport->deleted_at != null);
    }

}
