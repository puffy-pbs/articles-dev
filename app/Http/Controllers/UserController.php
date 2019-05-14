<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserStoreRequest;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return view('users.index', ['users' => $users]);
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $userRoles = $user->roles->keyBy('id')->keys()->toArray();
        $roles = Role::all();

        return view('users.update', ['user' => $user, 'userRoles' => $userRoles, 'roles' => $roles]);
    }

    public function save(UserEditRequest $userEditRequest)
    {
        $user = User::findOrFail($userEditRequest->id);
        $user->update(Input::all());

        $user->roles()->detach(Role::find($user->roles()->first()->id));

        $role = Role::findOrFail($userEditRequest->role);
        $user->roles()->save($role);

        return redirect('admin-area');
    }

    public function erase($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach(Role::find($user->roles()->first()->id));
        $user->forceDelete();

        return redirect('admin-area');
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    public function store(UserStoreRequest $userStoreRequest)
    {
        $newUser = new User();
        $fillables = $newUser->getFillable();
        foreach ($fillables as $fillable) {
            if (isset($userStoreRequest->$fillable)) {
                $newUser->$fillable = $userStoreRequest->$fillable;
            }
        }
        $newUser->password = bcrypt('secret');
        $newUser->save();

        $roleId = $userStoreRequest->role;

        if (!empty($roleId)) {
            $newUser->roles()->save(Role::find($roleId));
        }

        return redirect('admin-area');
    }
}
