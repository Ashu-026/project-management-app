<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;


class UserController extends Controller
{
    public function showUser()
    {
        $data = User::paginate(5);
        return view('users.users', compact('data'));
    }

    public function deleteUser(Request $request)
    {
        if(Auth::user()->role !== 'admin'){
            abort(403, 'Unauthorized action');
        }
        $user = User::findOrFail($request->user_id);
        $user->delete();
        return back()->with('success', 'User deleted .');
    }
    public function editUser(Request $request)
    {
        if(Auth::user()->role !== 'admin'){
            abort(403, 'Unauthorized action');
        }
        $user = User::findOrFail($request->user_id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->name = $validated["name"];
        $user->email = $validated["email"];

        if ($request->filled('new_password')) {
            if ($request->new_password === $request->confirm_new_password) {
                $user->password = $request->new_password;
            }
        }
        $user->save();
        return back()->with('success', 'User updated successfully.');
    }
}
