<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect(['Administrator', 'Author']);
        $roles->each(function ($role) {
            factory(\App\Role::class)->create(['name' => $role]);
        });
    }

    public function retrieveUserRole()
    {
        return range(1, 2);
    }
}
