<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = collect([
            ['email' => 'admin@teamsweepstakes.com', 'password' => 'Password@123','name' => 'Admin']
        ]);

        foreach ($users as $user){
            $exists = \App\User::query()->where('email',$user['email'])->first();

            if(!$exists){
                $exists = \App\User::query()->create([
                    'email' =>  $user['email'],
                    'password'  =>  bcrypt($user['password']),
                    'name'      =>  $user['name']
                ]);
            }


            $admin_role = \App\Role::query()->where('name','admin')->first();

            if($admin_role){
                if(!$exists->hasRole($admin_role->name)) {
                    $exists->roles()->attach($admin_role);
                }
            }




        }

    }
}
