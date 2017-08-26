<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(

            'Add Teams' =>  [
                'admin'
            ],
            'Edit Teams'    =>  [
                'admin'
            ],

            'Add Leagues' => [
                'admin'
            ],

            'Edit Leagues'  =>  [
                'admin'
            ],

            'Add Sports'    =>  [
                'admin'
            ],

            'Edit Sports'   =>  [
                'admin'
            ]

        );


        foreach ($permissions as $name => $permission){

            $permission_exists = \App\Permission::query()->where('display_name',$name)->first();
            if(!$permission_exists){
                $permission_exists = \App\Permission::query()->create([
                    'name'  =>  str_slug($name),
                    'display_name'  =>  $name
                ]);
            }


            foreach ($permission as $role){
                $role = \App\Role::query()->where('name',$role)->first();
                if($role){
                    if(!$role->hasPermission($permission_exists->name)){
                        $role->attachPermission($permission_exists);

                    }
                }
            }

        }
    }
}
