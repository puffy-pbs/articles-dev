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
        $administratorRole = \App\Role::find(\App\Role::ADMINISTRATOR);
        factory(User::class)
            ->create()
            ->each(function ($user) use ($administratorRole) {
                $user->roles()->save($administratorRole);
            });
    }
}
