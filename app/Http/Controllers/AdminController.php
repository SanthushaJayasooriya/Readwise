<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::orderBy('name')->get();

        return view('admin.users', compact('users'));
    }

    public function makeModerator(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with(
                'error',
                'Admin role cannot be changed.'
            );
        }

        $user->update([
            'role' => 'moderator'
        ]);

        return back()->with(
            'success',
            $user->name . ' promoted to moderator.'
        );
    }

    public function removeModerator(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with(
                'error',
                'Admin role cannot be changed.'
            );
        }

        $user->update([
            'role' => 'user'
        ]);

        return back()->with(
            'success',
            $user->name . ' changed to user.'
        );
    }
}