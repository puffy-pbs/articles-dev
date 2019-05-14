<?php

use App\Role;
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
            factory(Role::class)->create(['name' => $role]);
        });
    }
}
