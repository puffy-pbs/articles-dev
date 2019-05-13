<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Role::find(\App\Role::ADMINISTRATOR);
        factory(User::class)
            ->create()
            ->each(function ($user) use ($role) {
                dump($role);
                $roleDemo = factory(\App\Role::class)->make([
                    'name' => $role->name
                ]);
                $user->roles()->save($roleDemo);
            });
    }
}
