<?php

use App\User;
use App\Role;
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
        $roles = [Role::find(Role::ADMINISTRATOR), Role::find(Role::AUTHOR)];

        factory(User::class, 30)
            ->create()
            ->each(function ($user) use ($roles) {
                $role = $roles[mt_rand(0, 1)];
                $user->roles()->save($role);
            });
    }
}
