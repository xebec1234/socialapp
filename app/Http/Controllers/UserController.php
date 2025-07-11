<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{   
    //login 
    public function login(Request $request) {
        //validation of incoming data
        $validate = $request->validate([
            'username' => 'required',
            'userpassword' => 'required',
        ]);
        //validate if user is existing in database
        if(auth()->attempt(['name' => $validate['username'], 'password' => $validate['userpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }
    
    //logout
    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    //register
    public function register(Request $request) {
        //validation of incoming data
        $validated = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required'],
        ]);

        //password hashing
        $validated['password'] = bcrypt($validated['password']);

        //logging in after validating data
        $user = User::create($validated);
        auth()->login($user);
        return redirect('/');
    }
}
