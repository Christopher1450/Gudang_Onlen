<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function toggleRole(User $user)
    {
        if ($user->role === 'admin') {
            $user->role = 'user';
        } else {
            $user->role = 'admin';
        }
        $user->save();

        return back()->with('success', 'Role updated successfully!');
    }
}
