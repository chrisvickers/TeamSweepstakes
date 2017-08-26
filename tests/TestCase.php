<?php

namespace Tests;

use App\User;
use App\Role;
use App\Team;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

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


    public function adminUser(){
        $user = factory(User::class)->create();
        $user->roles()->attach($this->admin_role);
        return $user;
    }
}
