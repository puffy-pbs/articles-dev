<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(3);
        return view('users.index', compact('users'));
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $userRoles = $user->roles->keyBy('id')->keys()->toArray();
        $roles = Role::all();

        return view('users.update', ['user' => $user, 'userRoles' => $userRoles, 'roles' => $roles]);
    }

    public function save($id)
    {
        $user = User::findOrFail($id);
        $user->update(Input::all());

        $user->roles()->detach(Role::find($user->roles()->first()->id));

        $role = Role::findOrFail(Input::get('role'));
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

    public function register()
    {
        $newUser = new User();
        $fillables = $newUser->getFillable();
        foreach ($fillables as $fillable) {
            if (array_key_exists($fillable, Input::all())) {
                $newUser->$fillable = Input::get($fillable);
            }
        }
        $newUser->password = bcrypt('secret');
        $newUser->save();

        $roleId = Input::get('role');

        if (!empty($roleId)) {
            $newUser->roles()->save(Role::find($roleId));
        }

        return redirect('admin-area');
    }
}
