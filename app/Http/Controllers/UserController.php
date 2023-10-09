<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register');
    }

    public function handle(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5'],
            'email'=> 'required|email',
            'password'=>'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        
        return redirect()->route('auth.create')
        ->with('success', 'Registration successfully');
    }
}
