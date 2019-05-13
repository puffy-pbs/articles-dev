<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AdminUserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     * @param  \App\User  $user
     * @return void
     */
    public function view(?User $user)
    {
        if ($user === null) {
            return false;
        }

        $isUserAdmin = $user->roles->filter(function ($role) {
            return $role->id === Role::ADMINISTRATOR;
        });

        return $isUserAdmin;
    }
}
