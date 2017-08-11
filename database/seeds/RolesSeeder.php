<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            'Admin',
            'Moderator',
            'User'
        );


        foreach ($roles as $role){
            $role_exists = \App\Role::query()->where('name',$role)->first();
            if(!$role_exists){
                $role_exists = \App\Role::query()->create([
                    'name'  =>  str_slug($role),
                    'display_name'   =>  $role
                ]);
            }
        }
    }
}
