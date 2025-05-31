<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $user){
        $incomingField  = $user->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt(['name' => $incomingField['username'], 'password' => $incomingField['password']])) {
            $user->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $userInfo){
        $incomingField = $userInfo->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:50'],
        ]);

        $incomingField['password'] = bcrypt($incomingField['password']);
        $user = User::Create($incomingField);
        auth()->login($user);

        return redirect('/');
    }
}
