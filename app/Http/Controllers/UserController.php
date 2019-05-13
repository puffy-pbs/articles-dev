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
        $roles = Role::all();
        return view('users.update', ['user' => $user, 'roles' => $roles]);
    }

    public function save($id)
    {
        $user = User::findOrFail($id);
        $user->update(Input::all());
        return redirect('admin-area');
    }
}
